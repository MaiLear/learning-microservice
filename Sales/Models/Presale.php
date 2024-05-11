<?php
require_once './Config/Query.php';
require_once './Config/DataBase/Factory/DataBaseFactory.php';
class Presale extends Query{
    public function __construct()
    {
        $dataBaseFactory = new DataBaseFactory();
        parent::__construct($dataBaseFactory,'MYSQL');
    }

    public function store(string $tableName,array $atributtes):bool
    {
        $sql = "INSERT INTO $tableName(";
        $secondPartSql = "VALUES(";
        $values = array();
        foreach($atributtes as $key=>$atributte){
            $sql .=$key.',';
            $secondPartSql .= '?,'; 
            array_push($values,$atributte);
        }
        $secondPartSql = rtrim($secondPartSql,',').')';
        $sql = rtrim($sql,',').')'.' '.$secondPartSql;
        return $this->saveOrUpdate($sql,$values);
    }

    // public function update(string $tableName,object $attributes):bool
    // {
    //     $sql = "UPDATE $tableName SET ";
    //     $values = array();
    //     foreach($attributes as $key=>$attribute){
    //         $sql .=$key.'=?,';
    //         array_push($values,$attribute);
    //     }
    //     $sql = rtrim($sql,',');
    //     return $this->saveOrUpdate($sql,$values);
    // }

  
}