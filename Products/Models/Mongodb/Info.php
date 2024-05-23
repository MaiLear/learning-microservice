<?php
require_once './Config/MongoQuery.php';
require_once './Config/DataBase/Factory/DataBaseFactory.php';
class Info extends MongoQuery{
    public function __construct(){
        $dataBaseFactory = new DataBaseFactory();
        parent::__construct($dataBaseFactory,'MONGO');
    }

    public function store(array $logs, $nameCollection){
        return parent::save($logs,$nameCollection);
    }

}