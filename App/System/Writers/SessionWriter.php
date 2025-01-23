<?php
namespace App\System\Writers;
use LazarusPhp\DatabaseManager\QueryBuilder;
use LazarusPhp\DateManager\Date;
use LazarusPhp\SessionManager\Interfaces\SessionControl;
use PDO;

class SessionWriter implements SessionControl
{

    private $config;
    private $date;


    public function __construct(array $config=null)
    {
        $this->config = $config ?? null;
    }

    public function customBoot():void
    {
        $this->setCookie();
    }

    public function setCookie() :bool
    {
        return  setcookie(session_name(), session_id(), Date::asTimestamp(Date::withAddedTime("now","P".$this->config["expiry"]."D")), "/", "." . $_SERVER['HTTP_HOST']);
            
    }

    public function openQuery():bool
    {
        return true;
    }

    public function closeQuery():bool
    {
        return true;
    }
    public function readQuery($sessionID):mixed
    {
        $query = new QueryBuilder();
        $stmt = $query->sql("SELECT * FROM ".$this->config["table"]." WHERE session_id = :sessionID",[":sessionID"=>$sessionID])
        ->one(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public function writeQuery($sessionID,$data):bool
    {
        $date = Date::withAddedTime("now","P".$this->config["expiry"]."D")->format($this->config["format"]);
        $params =  [":sessionID"=>$sessionID,":data"=>$data,":expiry"=>$date];
        $query = new QueryBuilder();
        $query->asQuery("REPLACE INTO " . $this->config["table"] . " (session_id,data,expiry) VALUES(:sessionID,:data,:expiry)",$params);
        return true;
    } 
    public function destroyQuery($sessionID): bool
    {
        $query = new QueryBuilder();
        $params = [":sessionID"=>$sessionID];
        $query->asQuery("DELETE FROM " . $this->config["table"] . " WHERE session_id=:sessionID",$params);
        return true;
    }

    public function gcQuery():void
    {
        $expiry = Date::create("now");
        $expiry = $expiry->format("y-m-d h:i:s");

        try {
            $query = new QueryBuilder();
            $params = [":expiry"=>$expiry];
            $query->asQuery("DELETE FROM sessions WHERE expiry  < :expiry",$params);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage() . $e->getCode());
        }
    }

    
}