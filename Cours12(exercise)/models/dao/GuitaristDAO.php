<?php

class GuitaristDAO extends DAO {

    public function __construct () {
        parent::__construct("guitarists");
    }
    
    public function store ($guitarist) {
        $statement = $this->db->prepare("INSERT INTO guitarists (name, band, country) VALUES (?, ?, ?)");
        return parent::insert($statement, [$guitarist->name, $guitarist->band, $guitarist->country], $guitarist);
    }
    
    public function update($guitarist) {
        $statement = $this->db->prepare("UPDATE guitarists SET name = ?, band = ?, country = ? WHERE id = ?");
        return parent::insert($statement, [$guitarist->name, $guitarist->band, $guitarist->country, $guitarist->id], $guitarist);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Guitarist(
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["band"] ?? false,
            $data["country"] ?? false,
            false
        );
    }
}