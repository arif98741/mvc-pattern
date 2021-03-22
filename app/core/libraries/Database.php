<?php


class Database
{
    /**
     * @var
     */
    public static $instance;

    public function __construct()
    {
        $this->getInstance();
    }

    public function getInstance(): PDO
    {
        if (self::$instance == null) {
            self::$instance = self::loadConnection();
        }

        return self::$instance;
    }

    /**
     * Database Connection
     */
    private static function loadConnection(): PDO
    {
        try {
            $link = new PDO("mysql:host=" . HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->exec("SET CHARACTER SET utf8");
            return $link;
        } catch (PDOException $exc) {
            die("Field to Connect with Database" . $exc->getMessage());
        }
    }

    public function select()
    {

    }
}