<?php

class RecipeDao extends Dao {

    public function __construct() {
        parent::__construct("recipes");
    }

    public function store($recipe) {
        $statement = $this->db->prepare("INSERT INTO recipes (name, category_id) VALUES (?, ?)");
        return parent::insert($statement, [$recipe->name, $recipe->category_id], $recipe);
    }

    public function update($recipe) {
        $statement = $this->db->prepare("UPDATE recipes SET name = ?, category_id = ? WHERE id = ?");
        return parent::insert($statement, [$recipe->name, $recipe->category_id, $recipe->id], $recipe);
    }

    public function create($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new RecipeEntity (
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["category_id"] ?? false,
            false
        );
    }
}
