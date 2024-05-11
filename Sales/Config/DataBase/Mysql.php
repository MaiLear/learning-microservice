<?php
require_once './Config/DataBase/interfaces/IDatabase.php';
class Mysql implements IDatabase{
    private $host,$dbName,$user,$password;
    public static $mysqlInstance = null;
    protected function __construct()
    {
        $this->host = 'api-mysqlito-1';
        $this->dbName = 'api';
        $this->user = 'root';
        $this->password = 'mai';
    }

    public static function connect()
    {
        try{
            Mysql::$mysqlInstance = Mysql::$mysqlInstance ?? new Mysql();
            $mysql = Mysql::$mysqlInstance;
            $connection = new PDO("mysql:host={$mysql->host};dbname={$mysql->dbName}",$mysql->user,$mysql->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOException $e){
            throw new Exception("failed connection with database Mysql, to try again {$e->getMessage()}");
        }
    }
}