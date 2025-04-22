<?php

namespace app\core;

class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            $env = parse_ini_file(__DIR__ . '/../../.env');
            $dsn = "mysql:host={$env['DBHOST']};dbname={$env['DBNAME']};charset=utf8mb4";
            $user = $env['DBUSER'];
            $pass = $env['DBPASS'];

            try {
                self::$instance = new \PDO($dsn, $user, $pass);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("DB Connection failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}