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
            case 'POSGRESS':
                require_once '../Posgress.php';
                return 'por ahora nada';
                break;
            default:
                return new Exception('Connection no avaible');
                break;
        }
    }
}