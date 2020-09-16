<?php

namespace core;

use PDO;
use PDOException;

define('USER', 'root');
define('PWD', '');
define('HOST', 'localhost');
define('DBNAME', 'test_module');

class DataBase
{
    private static $db = null;

    public static function getDB()
    {
        if (self::$db == null) {
            try {
                $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8", USER, PWD);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$db = $pdo;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$db;
    }

    public function runQuery($query, $data)
    {
        try {
            $stmt = self::getDB()->prepare($query);
            $stmt->execute($data);
            return $stmt;
        } catch (PDOException $e) {
            return false;
        }
    }
}