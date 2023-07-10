<?php
class Database{
    private static $dbHost = "185.22.109.254";
    private static $dbName = "agencemsc_modele";
    private static $dbUser = "agencemsc_dev1";
    private static $dbPassword = "MSComOTOP!2023";
    private static $connexion = null;
    public static function connect(){
        try{
            self::$connexion = new PDO("mysql:host=".self::$dbHost.";port=3306".";dbname=".self::$dbName,self::$dbUser,self::$dbPassword);
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
        return self::$connexion;
    }
    public static function disconnect(){
        self::$connexion = null;
    }
}
$db = Database::connect();
$sql = "SELECT * FROM 'test' ";
$query = $db->prepare($sql);
$query->execute();
$elements = $query->fetchAll();
var_dump($elements);
$db = Database::disconnect();
?>