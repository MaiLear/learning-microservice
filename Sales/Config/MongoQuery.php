<?php
require_once './Config/DataBase/Factory/interfaces/IFactory.php';

class MongoQuery implements IFactory
{
    private $connection;

    public function __construct(private object $dataBaseFactory, string $dataBaseName)
    {
        $this->getDb($dataBaseName);
    }

    public function getDb(string $dataBaseName)
    {
        $this->connection = $this->dataBaseFactory->getDb($dataBaseName);
    }

    public function save(array $logs, string $nameCollection):bool
    {
        try {

            $collection = $this->connection->$nameCollection;
            $collection->insertOne($logs);
            return true;
        } catch (\Throwable $e) {
            var_dump("no can't connect with mongodb {$e->getMessage()}");
            return false;
        }
    }
}
