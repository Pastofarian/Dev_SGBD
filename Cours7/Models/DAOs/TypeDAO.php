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
        $statement = $this->db->prepare("INSERT INTO type (name) VALUES (?)");
        return parent::insert($statement, [$type->name], $type);
    }

    public function update($type) {
        $statement = $this->db->prepare("UPDATE type SET name = ? WHERE id = ?");
        return parent::insertUpdate($statement, [$type->name], $type);
    }
}