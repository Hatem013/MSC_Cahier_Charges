<?php

abstract class Model{
    private $host = "localhost";
    private $dbname = "j";
    private $username = "root";
    private $password = "";

    protected $connexion;

    public $table;
    public $id;

    public function getConnexion(){
        $this->connexion = null;

        try{
            $this->connexion = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Erreur de connexion : ".$exception->getMessage();
        }
    }

    public function getAll(){
        $sql = "SELECT * FROM " . $this->table;

        $query = $this->connexion->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOne(){
        $sql = "SELECT * FROM ". $this->table." WHERE id = :id";

        $query = $this->connexion->prepare($sql);
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);

    }
}
