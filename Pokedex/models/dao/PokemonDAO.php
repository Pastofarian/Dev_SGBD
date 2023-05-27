<?php

class PokemonDAO extends DAO {

    public function __construct () {
        parent::__construct("pokemons");
    }

public function store ($pokemon) {
        $statement = $this->db->prepare("INSERT INTO pokemons (name, sprite) VALUES (?, ?)");
        return parent::insert($statement, [$pokemon->name, $pokemon->sprite], $pokemon);
    }
    
    public function update($pokemon) {
        $statement = $this->db->prepare("UPDATE pokemon SET name = ?, sprite = ? WHERE id = ?");
        return parent::insert($statement, [$pokemon->name, $pokemon->sprite, $pokemon->id], $pokemon);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Pokemon(
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["sprite"] ?? false,
            false
        );
    }
    //méthode pour vérifier si un Pokemon est déjà dans la DB
    public function exists ($id) {
        $statement = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE id = ?");
        try {
            $statement->execute([$id]);
            $count = $statement->fetchColumn();
            return $count > 0;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    
}
