<?php

/**
get a database connection object which can be used in the app wherever required
 */

class db
{

    /**
     * @return PDO
     */
    private $connection;

    function __construct()
    {
        $this->connection = null;
    }
    function __destruct() {
        $this->connection = null;
    }

    function con()
    {
        try {

            $this->connection = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->connection->query("SET time_zone = '+5:30', character_set_results = 'UTF8MB4', character_set_client = 'UTF8MB4', character_set_connection = 'UTF8MB4';");

	    $this->connection->query("SET SESSION sql_mode = (SELECT REPLACE(@@SESSION.sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
            return $this->connection;

        } catch (PDOException $e) {
		print_r($e);
            require_once APP_ROOT . "/error.php";
            exit;
        }

    }
    
};
