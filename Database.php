<?php

require_once('Constantes.php');

class Database
{
    static $db = null;

    static function connexionBD()
    {
        if (self::$db != null)
            return self::$db;

        try {
            self::$db = new PDO('pgsql:host=' . DB_SERVER . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
        return self::$db;
    }
}

?>