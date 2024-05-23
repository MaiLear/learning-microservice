<?php
require_once './Config/Query.php';
require_once './Config/DataBase/Factory/DataBaseFactory.php';
class Sale extends Query{
    public function __construct()
    {
        $dataBaseFactory = new DataBaseFactory();
        parent::__construct($dataBaseFactory,'MYSQL');
    }

    public function getTotal(string $tableName,string $columnName){
        $sql = "SELECT SUM($columnName) AS total FROM $tableName";
        $data = $this->show($sql);
        return $data;
    }

    public function getAllSales(string $nameTable):array{
        $data = parent::getAll($nameTable);
        return $data;
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

    public function update(string $tableName,int $id,array $attributes):bool
    {
        $sql = "UPDATE $tableName SET ";
        $values = array();
        foreach($attributes as $key=>$attribute){
            $sql .=$key.'=?,';
            array_push($values,$attribute);
        }
        array_push($values,$id);
        $sql = rtrim($sql,',').' '."WHERE id=?";
        return $this->saveOrUpdate($sql,$values);
    }
}