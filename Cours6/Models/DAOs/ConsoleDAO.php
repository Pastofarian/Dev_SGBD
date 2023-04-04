<?php

require_once('Models/DAOs/BaseDAO.php');

class ConsoleDAO extends BaseDAO {

    public function __construct() {
        parent::__construct('consoles');
    }

    public function createEntity ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Console(
            $data["id"] ?? false,
            $data["name"] ?? false
        );
    }

    public function store ($console) {
        $statement = $this->db->prepare("INSERT INTO consoles (name) VALUES (?)");
        return parent::insertStore($statement, [$console->name], $console);
    
        // try {
        //     $statement->execute([$console->name]);
        //     $connection_db = $this->db;
        //     $derniere_id = $connection_db->lastInsertId();
        //     $console->id = $derniere_id;
        //     return $console;
        // } catch (PDOException $exception) {
        //     var_dump($exception);
        //     return false;
        // }
    }

    public function update($console) {
        $statement = $this->db->prepare("INSERT INTO consoles (name) VALUES (?)");
        return parent::insertUpdate($statement, [$console->name], $console);
        
        // try {
        //     $statement->execute([$console->name, $console->id]);
        //     $rowsAffected = $statement->rowCount();
            
        //     if ($rowsAffected > 0) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // } catch (PDOException $exception) {
        //     var_dump($exception);
        //     return false;
        // }
    }

}