<?php

namespace App\System;

use App\System\exception\MvcDatabaseConnectionException;
use App\System\Libraries\Database\Database;
use PDO;
use PDOStatement;

class Model
{
    /**
     * @var PDO
     */
    protected $connection;

    /**
     * @var
     */
    protected $table;

    protected $columns;
    /**
     * @var
     */
    protected $result;
    /**
     * @var false|PDOStatement
     */
    protected $statement;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->connection = Database::getInstance();
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $limit1 = $limit;
    }

    /**
     * Select Data from Database
     * @param string|array $columns
     * @param string $orderby
     * @param string $order
     * @return Model
     */
    public function select(string|array $columns = '*', string $orderby = '', string $order = '')
    {
        if (is_array($columns)) {
            $this->columns = implode(',', $columns);
        }
        $this->columns = $columns;
        return $this;
        /*try {
            $query = "select {$columns} from {$this->table}";
            $this->statement = $this->init($query);
            if ($this->statement->execute()) {
                return $this;
            }

            throw new \PDOException("library  does not exist");

        } catch (\PDOException $exception) {
            $exception = new MvcDatabaseConnectionException($exception->getMessage());

        }*/
    }

    public function table(string $table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return Model
     */
    public function get()
    {
        try {

            if ($this->statement == null) {

                throw new MvcDatabaseConnectionException('someting wrong');
            } else {
                if ($type == 5) {
                    $type = PDO::FETCH_OBJ;
                } elseif (2) {
                    $type = PDO::FETCH_ASSOC;
                } else {

                    $type = PDO::FETCH_ASSOC;
                }
                $this->result = $this->statement->fetchAll($type);
                $this->total = $this->statement->rowCount();
                return $this;
            }

        } catch (MvcDatabaseConnectionException $exception) {
            throw new MvcDatabaseConnectionException($exception->getMessage());
        }

    }

    public function getClass()
    {
        return $this;
    }

    protected function insert()
    {
    }

    protected function query($sql)
    {
        return $sql;
    }

    protected function delete()
    {

    }

    /**
     * Prepare Statement
     * @param $query
     * @return false|PDOStatement
     */
    private function init($query)
    {
        return $this->connection->prepare($query);
    }
}
