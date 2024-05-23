<?php
require_once './Config/DataBase/interfaces/IDatabase.php';
require_once './vendor/autoload.php';
class Mongo implements IDatabase
{
    private $host, $dbName, $user, $password;
    public static $mongoInstance = null;
    protected function __construct()
    {
        $this->host = 'api-monguito-1';
        $this->dbName = 'logs';
        $this->user = 'mai';
        $this->password = '123';
    }

    public static function connect()
    {
        try {
            Mongo::$mongoInstance = Mongo::$mongoInstance ?? new Mongo();
            $mongo = Mongo::$mongoInstance;
            $connection = new MongoDB\Client("mongodb://{$mongo->user}:{$mongo->password}@{$mongo->host}:27017/{$mongo->dbName}?authSource=admin");
            return $connection->selectDatabase($mongo->dbName);
        } catch (\Throwable $e) {
            echo $e->getMessage();
            throw new Exception("failed connection with database Mongo, to try again {$e->getMessage()}");
        }
    }
}
