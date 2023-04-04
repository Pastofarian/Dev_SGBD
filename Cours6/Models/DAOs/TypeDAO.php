<?php

require_once('Models/DAOs/BaseDAO.php');

class TypeDAO extends BaseDAO {
    public function __construct() {
        parent::__construct('type');
    }

    public function createEntity ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Type (
            $data["id"] ?? false,
            $data["name"] ?? false,
            Game::where('type_id', $data["id"])
        );
    }

    public function store ($type) {
        $statement = $this->db->prepare("INSERT INTO type (name) VALUES (?)");
        return parent::insert($statement, [$type->name], $type);

        // $statement = $this->db->prepare("INSERT INTO type (name) VALUES (?)");
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

    public function update($type) {
        $statement = $this->db->prepare("INSERT INTO type (name) VALUES (?)");
        return parent::insertUpdate($statement, [$type->name], $type);
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