<?php


namespace app\core;


use app\core\exception\MvcDBException;
use app\core\libraries\Database;
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

    /**
     * @var
     */
    protected $result;
    /**
     * @var false|PDOStatement
     */
    protected $statement;
    /**
     * @var int
     */
    private $total;

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $db = Database::getInstance();
        $this->connection = $db->connection;
    }

    protected function insert()
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

    protected function query($sql)
    {
        return $sql;
    }

    /**
     * Select Data from Database
     * @param string $columns
     * @return array
     */
    protected function select($columns = '')
    {
        try {

            $query = "select {$columns} from {$this->table}";
            $this->statement = $this->init($query);
            if ($this->statement->execute()) {
                return $this;
            } else {

                throw new \PDOException("library  does not exist");
            }

        } catch (\PDOException $exception) {
            $exception = new MvcDBException($exception->getMessage());
            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));

        }
    }


    protected function delete()
    {

    }

    /**
     * @param $type
     * @return array
     */
    protected function get($type = 5)
    {
        switch ($type) {
            case 5:
                $type = PDO::FETCH_OBJ;
            case 2:
                $type = PDO::FETCH_ASSOC;
            default:
                $type = PDO::FETCH_ASSOC;
        }

        try {

            if ($this->statement == null) {

                throw new MvcDBException('statement is null');
            } else {
                $this->result = $this->statement->fetchAll($type);
                $this->total = $this->statement->rowCount();
                return $this;
            }

        } catch (MvcDBException $exception) {
            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));
        }

    }
}