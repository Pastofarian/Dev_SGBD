<?php

class GameDAO {
    private $db;
    
    public function __construct () {
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
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Game(
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["type"] ?? false
        );
    }
    
    public function store ($game) {
        $statement = $this->db->prepare("INSERT INTO games (name, type) VALUES (?, ?)");
        try {
            $statement->execute([$game->name, $game->type]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            //recup la derniere ID inserée $this->db->lastInsertId();
            $connection_db = $this->db;
            $derniere_id = $connection_db->lastInsertId();
            $game->id = $derniere_id;
            return $game;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    public function destroy ($id) {
        $statement = $this->db->prepare("DELETE FROM games WHERE id = ?");
        try {
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    public function where ($attr, $value) {
        $statement = $this->db->prepare("SELECT * FROM games WHERE {$attr} = ?");
        try {
            $statement->execute([$value]);
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
    
    public function first ($attr, $value) {
        $statement = $this->db->prepare("SELECT * FROM games WHERE {$attr} = ?");
        try {
            $statement->execute([$value]);
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
}