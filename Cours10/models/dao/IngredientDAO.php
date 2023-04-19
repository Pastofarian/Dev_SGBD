<?php

class IngredientDAO extends DAO {

    public function __construct () {
        parent::__construct("ingredients");
    }
    
    public function store ($ingredient) {
        $statement = $this->db->prepare("INSERT INTO ingredients (name) VALUES (?)");
        return parent::insert($statement, [$ingredient->name], $ingredient);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Ingredient(
            $data["id"] ?? false,
            $data["name"] ?? false,
            false
        );
    }

    public function update($ingredient) {
        $statement = $this->db->prepare("UPDATE ingredients SET name = ? WHERE id = ?");
        return parent::insert($statement, [$ingredient->name, $ingredient->id], $ingredient);
    }

}