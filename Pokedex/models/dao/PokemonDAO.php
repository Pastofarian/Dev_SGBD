<?php

class PokemonDAO extends DAO {

    public function __construct () {
        parent::__construct("pokemons");
    }

public function store ($pokemon) {
        $statement = $this->db->prepare("INSERT INTO pokemons (name, sprite, moves, type) VALUES (?, ?, ?, ?)");
        return parent::insert($statement, [$pokemon->name, $pokemon->sprite, json_encode($pokemon->moves), json_encode($pokemon->type)], $pokemon);
    }
    
    public function update($pokemon) {
        $statement = $this->db->prepare("UPDATE pokemon SET name = ?, sprite = ?, moves = ?, type = ? WHERE id = ?");
        return parent::insert($statement, [$pokemon->name, $pokemon->sprite, json_encode($pokemon->moves), json_encode($pokemon->type), $pokemon->id], $pokemon);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Pokemon(
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["sprite"] ?? false,
            json_decode($data["moves"] ?? "[]"),
            json_decode($data["type"] ?? "[]"),
            false
        );
    }
    //méthode pour vérifier si un Pokemon est déjà dans la DB
    public function exists ($name) {
        $statement = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE name = ?");
        try {
            $statement->execute([$name]);
            $count = $statement->fetchColumn();
            return $count > 0;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    
    
}
