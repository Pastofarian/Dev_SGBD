<?php

class Game {
    private $id;
    private $name;
    private $type;

    
    public function __construct ($id, $name, $type) {
        $this->email = $id;
        $this->password = $name;
        $this->type = $type;
        $this->connect();
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

    public function __toString()
    {
        return $this->name . " est de type " . $this->type;
    }

    public function connection(){
        $this->db = new PDO('mysql:host=localhost;dbname=games', 'root', 'toto');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function fetch ($id) {
        //preparer la query
        $statement = $this->db->prepare("SELECT * FROM games WHERE id = ?");
        
        try {
            //executer la query
            $statement->execute([$id]);
            //récupérer le résultat
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                //créer un objet game
                $found = new Game($result["id"], $result["name"], $result["type"]);
                //renvoyer l'objet game
                return $found;
            }
            return false;
            
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }

    public function fetchAll(){
        $statement = $db_con->prepare("SELECT * FROM games WHERE id = ? ");
      
        try {
            $statement->execute($id);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $game = new Game($result);
            return $game;

        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }

    public function store($name, $type){
        $statement = $db_con->prepare("INSERT INTO games(name, type) VALUES($name, $type)");
      
        try {
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $game = new Game($result);
            return $game;

        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }

    public function destroy(){

    }
}

