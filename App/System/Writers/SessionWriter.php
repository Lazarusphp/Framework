<?php
namespace App\System\Writers;
use LazarusPhp\DatabaseManager\QueryBuilder;
use LazarusPhp\DateManager\Date;
use SessionhandlerInterface;
use PDO;

class SessionWriter Implements SessionHandlerInterface
{

    private $config;
    private $date;

    public function passConfig(array $config)
    {
        $this->config = $config;
        $required = ["days","table"];
        if(is_array($config))
        {
            foreach ($required as $key) {
                if (!array_key_exists($key,$config)) {
                    throw new \InvalidArgumentException("Missing required config key: $key");
                }
            }
        } 
    }

    public function open(?string $path,?string $name):bool
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
        $stmt = $query->sql("SELECT * FROM ". $this->config["table"] ." WHERE session_id = :sessionID",[":sessionID"=>$sessionID])
        ->one(PDO::FETCH_ASSOC);
        return $stmt ? $stmt['data'] : '';
    }

    public function write($sessionID,$data):bool
    {
        $date = Date::withAddedTime("now","P".$this->config["days"]."D")->format("y-m-d h:i:s");  
        $params =  [":sessionID"=>$sessionID,":data"=>$data,":expiry"=>$date];
        $query = new QueryBuilder();
        $query->asQuery("REPLACE INTO ". $this->config["table"] . "  (session_id,data,expiry) VALUES(:sessionID,:data,:expiry)",$params);
        return true;
    } 
    public function destroy($sessionID): bool
    {
        $query = new QueryBuilder();
        $params = [":sessionID"=>$sessionID];
        $query->asQuery("DELETE FROM ". $this->config["table"] . "  WHERE session_id=:sessionID",$params);
        return true;
    }

    public function gc(int $maxlifetime=1400):int|false
    {
        $expiry = Date::create("now");
        $expiry = $expiry->format("y-m-d h:i:s");
        
        try {
            $query = new QueryBuilder();
            $params = [":expiry"=>$expiry];
            $query->asQuery("DELETE FROM ". $this->config["table"] . "  WHERE expiry  < :expiry",$params);
            return true;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage() . $e->getCode());
            return false;
        }
    }

    
}