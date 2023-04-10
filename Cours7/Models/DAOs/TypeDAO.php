<?php

class TypeDAO extends BaseDAO {
    public function __construct() {
        parent::__construct('types');
    }

    public function createEntity ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Type (
            $data["id"] ?? false,
            $data["name"] ?? false,
        );
    }

    public function store ($type) {
        $statement = $this->db->prepare("INSERT INTO types (name) VALUES (?)");
        return parent::insertStore($statement, [$type->name], $type);
    }

    public function update($type) {
        $statement = $this->db->prepare("UPDATE types SET name = ? WHERE id = ?");
        return parent::insertUpdate($statement, [$type->name, $type->id], $type);
    }
}