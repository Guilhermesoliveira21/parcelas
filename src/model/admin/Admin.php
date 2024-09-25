<?php 

abstract class Admin {
    
    private static $host = 'localhost';
    private static $dbName = 'sistema';
    private static $username = 'root';
    private static $port = '3307';
    private static $password = '';
    private static $conn;

    protected function connect() {
        try {
            self::$conn = new PDO('mysql:host='.self::$host.';port='.self::$port.';dbname='.self::$dbName, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }   


}

?>
