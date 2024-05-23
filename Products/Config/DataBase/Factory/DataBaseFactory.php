<?php
require_once './Config/DataBase/Factory/interfaces/IFactory.php';

class DataBaseFactory implements IFactory{

    public function getDb(string $dataBaseName):object|string
    {
        switch($dataBaseName){
            case 'MYSQL':
                require_once './Config/DataBase/Mysql.php';
                return Mysql::connect();
                break;
            case 'MONGO':
                require_once './Config/DataBase/Mongodb.php';
                return Mongo::connect();
                break;
            default:
                return new Exception('Connection no avaible');
                break;
        }
    }
}