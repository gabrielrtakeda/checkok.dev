<?php

namespace Database\Adapter;

use Database\Connection\AbstractDatabaseConnection;
use Database\Driver\Interfaces\DriverInterface;

class MysqlDatabaseAdapter
extends AbstractDatabaseConnection
implements DriverInterface
{
    protected $tableDataGateway;

    public function __construct()
    {
        $config = include __DIR__ . '/../../../config/database.config.php';
        $databaseHost    = 'host='    . $config['host'];
        $databaseName    = 'dbname='  . explode('.', $this->tableDataGateway)[0];
        $databaseCharset = 'charset=' . $config['charset'];

        try {
            $this->connection = new \PDO(
                "mysql:{$databaseHost};{$databaseName};{$databaseCharset}",
                $config['username'],
                $config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function insert(array $saveEntity)
    {
        $fields = implode(', ', array_keys($saveEntity));
        $values = implode(', ', $this->strinfy(array_values($saveEntity)));

        $expression = "INSERT INTO {$this->tableDataGateway} ({$fields}) VALUES ({$values});";
        try {
            $this->connection->exec($expression);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @todo
     */
    public function update(array $saveEntity)
    {}

    /**
     * @todo
     */
    public function select($expression)
    {}

    /**
     * @todo
     */
    public function delete($id)
    {}

    private function strinfy($arrayItem)
    {
        foreach ($arrayItem as $key => $item) {
            $arrayItem[$key] = "'" . $item . "'";
        }
        return $arrayItem;
    }
}
