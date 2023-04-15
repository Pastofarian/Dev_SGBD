<?php

class CategoryDao extends Dao {

    public function __construct() {
        parent::__construct("categories");
    }

    public function store($category) {
        $statement = $this->db->prepare("INSERT INTO categories (name) VALUES (?)");
        return parent::insert($statement, [$category->name], $category);
    }

    public function update($category) {
        $statement = $this->db->prepare("UPDATE categories SET name = ? WHERE id = ?");
        return parent::insert($statement, [$category->name, $category->id], $category);
    }

    public function create($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new CategoryEntity (
            $data["id"] ?? false,
            $data["name"] ?? false,
            false
        );
    }
}
