<?php

require_once('Models/DAOs/BaseDAO.php');

class GameDAO extends BaseDAO {

    public function __construct() {
        parent::__construct('games');
    }

        public function createEntity ($data) {
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
        $statement = $this->db->prepare("INSERT INTO {$this->tableName} (name, type) VALUES (?, ?)");
        try {
            $statement->execute([$game->name, $game->type]);
            $connection_db = $this->db;
            $derniere_id = $connection_db->lastInsertId();
            $game->id = $derniere_id;
            return $game;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }

    public function update($game) {
        $statement = $this->db->prepare("UPDATE {$this->tableName} SET name = ?, type = ? WHERE id = ?");
        try {
            $statement->execute([$game->name, $game->type, $game->id]);
            $rowsAffected = $statement->rowCount();
            
            if ($rowsAffected > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }

}