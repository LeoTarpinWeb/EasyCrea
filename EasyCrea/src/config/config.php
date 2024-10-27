<?php

class DatabaseConfig {
    private static $host = 'mysql-leotarpin.alwaysdata.net';
    private static $db_name = 'leotarpin_bdreigns';
    private static $username = 'leotarpin_1';
    private static $password = 'zX5%eI7:hB5<iB1@zM7*mA5"tR0$gF3%';
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
