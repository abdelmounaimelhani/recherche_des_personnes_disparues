<?php
class Connexion{
    public static function Connexion(){
        $host = 'localhost';
        $dbname = 'project';
        $username = 'root';
        $password = '123456789';
    
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "<script>alert('Connection failed: '" . $e->getMessage().");</script>" ;
        }
    }
}