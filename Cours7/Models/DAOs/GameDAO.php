<?php

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
            $data["type_id"] ?? false
        );
    }

    public function store ($game) { //$game->getType()->id
        $statement = $this->db->prepare("INSERT INTO {$this->tableName} (name, type_id) VALUES (?, ?)");
    return parent::insertStore($statement, [$game->name, $game->getType()->id], $game);
    }

    public function update($game) {
        $statement = $this->db->prepare("UPDATE {$this->tableName} SET name = ?, type_id = ? WHERE id = ?");
        return parent::insertUpdate($statement, [$game->name, $game->type_id, $game->id], $game);
    }
}
    

