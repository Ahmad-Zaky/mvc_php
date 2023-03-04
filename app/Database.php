<?php

class DB
{
    private $pdo = null;

    private $result;

    private static $instance = NULL;

    private function __construct()
    {
        $this->openConnectionDB();
    }

    public function openConnectionDB()
    {
        global $config;

        try {
            $this->pdo = new PDO(
                "mysql:host=". $config["db"]["host"] .";dbname=". $config["db"]["database"],
                $config["db"]["username"],
                $config["db"]["password"]
            );

            return $this;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    
    public static function instance()
    {
        if(! self::$instance) {
            self::$instance = new DB();
        }

        return self::$instance;
    }
    
    public function connection()
    {
        return $this->pdo;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function query($statement, $data = [])
    {
        try {
            $this->result = $this->pdo->prepare($statement);

            if (! empty($data)) $this->bindParams($data);

            $this->result->execute();

            return $this;
        } catch (PDOException $e) {
            die("Syntax Error: ". $e->getMessage());
        }
    }

    public function bindParams($data = [], $withKey = false) 
    {
        $c = 1;
        foreach ($data as $key => $value) {
            $type = is_numeric($value) ? PDO::PARAM_INT : PDO::PARAM_STR;

            $withKey
                ? $this->result->bindParam(':'.$key, $value, $type)
                : $this->result->bindParam($c, $value, $type);
            
            $c++;
        }

        return $this;
    }

    public function get()
    {
        try {
            return $this->result->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Syntax Error: ". $e->getMessage());
        }
    }

    public function first()
    {
        try {
            $entries = $this->result->fetchAll(PDO::FETCH_OBJ);

            return count($entries) ? $entries[0] : null;
        } catch (PDOException $e) {
            die("Syntax Error: ". $e->getMessage());
        }
    }

    public function fetch()
    {
        try {
            return $this->result->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Syntax Error: ". $e->getMessage());
        }
    }

    public function insertedId(){
        return $this->pdo->lastInsertId();
    }
}

$db = DB::instance(); 
$connection = $db->connection();