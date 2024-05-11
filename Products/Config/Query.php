<?php
require_once './Config/DataBase/Factory/interfaces/IFactory.php';
class Query implements IFactory{
    private object $connection;

    protected function __construct(private object $dataBaseFactory,string $dataBaseName){
        $this->getDb($dataBaseName);
    }

    public function getDb(string $dataBaseName)
    {
        $this->connection = $this->dataBaseFactory->getDb($dataBaseName);
    }

    public function getAll(string $tableName):array|bool
    {
        try{
            $query = $this->connection->query("SELECT * FROM $tableName");
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(PDOException $e){
            var_dump($e->getMessage());
            return false;
        }
    }


    public function saveOrUpdate(string $sql,array $values):bool{
        try{
            $query = $this->connection->prepare($sql);
            $query->execute($values);
            return true;
        }catch(PDOException $e){
            var_dump($e->getMessage());
            return false;
        }
    }
}