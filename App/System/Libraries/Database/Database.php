<?php

namespace App\System\Libraries\Database;

use App\System\Exception\MvcDatabaseConnectionException;
use PDO;
use PDOException;

class Database
{

    /**
     * @var
     */
    private static $instance;

    public $connection;


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::$instance->createConnection();
        }
        return self::$instance;
    }

    /**
     * Database Connection
     */
    private function createConnection()
    {
        try {
            $link = new \PDO("mysql:host=" . HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->exec("SET CHARACTER SET utf8");
            $this->connection = $link;
        } catch (PDOException $exc) {
            throw new MvcDatabaseConnectionException("Failed to connect to database: " . $exc->getMessage());
        }
    }
}
