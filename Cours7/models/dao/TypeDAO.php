<?php

class TypeDAO extends DAO {

    public function __construct () {
        parent::__construct("types");
    }
    
    public function store ($type) {
        $statement = $this->db->prepare("INSERT INTO types (name) VALUES (?)");
        return parent::insert($statement, [$type->name], $type);
    }
    
    public function create($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Type(
            $data["id"] ?? false,
            $data["name"] ?? false
        );
    }
    
}