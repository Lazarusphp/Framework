<?php
namespace App\System\Writers;
use LazarusPhp\DatabaseManager\QueryBuilder;
use LazarusPhp\DateManager\Date;
use SessionhandlerInterface;
use PDO;

class SessionWriter Implements SessionHandlerInterface
{

    private $config = [
        "table"=>"sessions",
        "expiry"=>1,
        "format"=>"Y-m-d H:i:s"
    ];
    private $date;


    public function __construct(array $config = [])
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

    public function open($path,$name):bool
    {
        return true;
    }

    public function close():bool
    {
        return true;
    }
    public function read(string $sessionID):string | false
    {
        $query = new QueryBuilder();
        $stmt = $query->sql("SELECT * FROM sessions WHERE session_id = :sessionID",[":sessionID"=>$sessionID])
        ->one(PDO::FETCH_ASSOC);
        return $stmt ? $stmt['data'] : '';
    }

    public function write($sessionID,$data):bool
    {
        $date = "2015-11-22 00:00:00";
        $params =  [":sessionID"=>$sessionID,":data"=>$data,":expiry"=>$date];
        $query = new QueryBuilder();
        $query->asQuery("REPLACE INTO sessions (session_id,data,expiry) VALUES(:sessionID,:data,:expiry)",$params);
        return true;
    } 
    public function destroy($sessionID): bool
    {
        $query = new QueryBuilder();
        $params = [":sessionID"=>$sessionID];
        $query->asQuery("DELETE FROM sessions WHERE session_id=:sessionID",$params);
        return true;
    }

    public function gc(int $maxlifetime):int | false
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