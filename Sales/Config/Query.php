<?php
require_once './Config/DataBase/Factory/interfaces/IFactory.php';
require_once './Responses/ControllerResponses.php';
class Query implements IFactory
{
    private object $connection;
    private $responses;

    protected function __construct(private object $dataBaseFactory, string $dataBaseName)
    {
        $this->getDb($dataBaseName);
        $this->responses = ControllerResponses::getInstace();
        $this->responses->clearResponses();
    }

    public function getDb(string $dataBaseName)
    {
        $this->connection = $this->dataBaseFactory->getDb($dataBaseName);
    }

    public function getAll(string $tableName): array|bool
    {
        try {
            $query = $this->connection->query("SELECT * FROM $tableName");
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }


    public function saveOrUpdate(string $sql, array $values): bool|string
    {
        try {
            $query = $this->connection->prepare($sql);
            $query->execute($values);
            return true;
        } catch (PDOException $e) {
            $this->responses->setResponses('saveOrUpdate', $e->getMessage());
            return $this->responses->getResponses('saveOrUpdate');
        }
    }

    public function show(string $sql)
    {
        try {
            $query = $this->connection->query($sql);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }
}
