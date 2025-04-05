<?php
namespace App\System\Writers;
use LazarusPhp\LazarusDb\QueryBuilder;
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
        $stmt = QueryBuilder::table($this->config["table"])->select()->where("session_id",$sessionID)->first(PDO::FETCH_ASSOC);
        return $stmt ? $stmt['data'] : '';
    }

    public function write(string $sessionID,string $data):bool
    {
        $date = Date::withAddedTime("now","P".$this->config["days"]."D")->format("y-m-d h:i:s");  
        $params = ["session_id"=>$sessionID,"data"=>$data,"expiry"=>$date];
        return QueryBuilder::table($this->config["table"])->replace($params) ? true : false;
    } 
    public function destroy(string $sessionID): bool
    {
   
        return QueryBuilder::table($this->config["table"])->delete()->where("session_id",$sessionID)->save() ? true : false;
    }

    public function gc(int $maxlifetime=1400):int|false
    {
        $expiry = Date::create("now");
        $expiry = $expiry->format("y-m-d h:i:s");
        
        try {
            return QueryBuilder::table($this->config["table"])->delete()->where("expiry","<",$expiry) ? true : false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage() . $e->getCode());
            return false;
        }
    }

    
}