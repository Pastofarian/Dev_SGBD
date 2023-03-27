<?php
//Warning : cette façon de faire comporte quelques soucis, le but est d'y aller étape par étape. Dans un premier temps notre Entité (ici notre classe Game) doit pouvoir gérer les opérations de CRUD sur elle-même, nous avons déjà vu en théorie comment le code allait évoluer pour incorporer une nouvelle couche : la DAL (data access layer)
class Game {
    private $id;
    private $name;
    private $type;
    private $db;

    public function __construct ($id, $name, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->connect();
    }
    
    public function connect () {
        $this->db = new PDO('mysql:host=localhost;dbname=games', 'root', 'toto');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    
    public function fetch ($id) {
        $statement = $this->db->prepare("SELECT * FROM games WHERE id = ?");
        try {
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                //la méthode create est présente plus bas, elle sert à créer un objet Game avec quelques vérifications
                return $this->create($result);
            }
            return false;
            
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
    
    public function fetch_all () {
        $statement = $this->db->prepare("SELECT * FROM games");
        try {
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                $list = array();
                foreach($results as $result) {
                    //la méthode create est présente plus bas, elle sert à créer un objet Game avec quelques vérifications
                    array_push($list, $this->create($result));
                }
                return $list;
            }
            return false; 
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
    
    public function store () {
        $statement = $this->db->prepare("INSERT INTO games (name, type) VALUES (?, ?)");
        try {
            $statement->execute([$this->name, $this->type]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            //je récupère la dernière ID inserée en DB pour set l'id de mon objet
            $this->id = $this->db->lastInsertId();
            return true;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    public function destroy () {
        $statement = $this->db->prepare("DELETE FROM games WHERE id = ?");
        try {
            $statement->execute([$this->id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    public function create ($data) {
        //petite méthode me permettant de créer mes objets games
        if (empty($data["id"])) {
            return false;
        }
        return new Game(
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["type"] ?? false
        );
        //opérateur ?? => équivaut à faire isset($valeur) ? $valeur : x;
        //donc $data["id"] ?? false => isset($data["id"]) ? $data["id"] : false;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
    
    public function __set ($prop, $value) {
        if (property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name} ({$this->type})";
    }
}