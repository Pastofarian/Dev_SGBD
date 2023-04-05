<?php

class GameDAO extends DAO {

    public function __construct () {
        parent::__construct("games");
    }
    
    public function store ($game) {
        $statement = $this->db->prepare("INSERT INTO games (name, type) VALUES (?, ?)");
        return parent::insert($statement, [$game->name, $game->type], $game);
    }
    
    public function create($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Game(
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["type_id"] ?? false
        );
    }
    
}