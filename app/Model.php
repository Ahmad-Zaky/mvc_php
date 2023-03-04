<?php

class Model
{
    protected $table = "";

    public static function calledClass() 
    {
        return get_called_class();
    }

    public static function getTable() 
    {
        return (new (self::calledClass()))->table;
    }

    public function all() 
    {
        global $db;

        return $db->query("SELECT * FROM {$this->table}")->get();
    }

    public function find(int $id)
    {
        global $db;

        return $db->query("SELECT * FROM {$this->table} WHERE ?", ["id" => $id])->fetch();
    }

    public static function create(array $data) 
    {
        global $db;
        
        $table = self::getTable();
        $fields = implode(', ', array_keys($data));
        $placeHolders = implode(', ', array_fill(0, count($data), "?"));

        return $db->query("INSERT INTO {$table} ({$fields}) VALUES ({$placeHolders})", $data)->getResult();
    }

    public function update(int $id, array $data) 
    {
    
    }

    public function delete(int $id) 
    {
    
    }
}