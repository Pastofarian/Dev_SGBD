<?php

class BeerDAO extends DAO {

    public function __construct () {
        parent::__construct("beers");
    }
    
    public function store ($beer) {
        $statement = $this->db->prepare("INSERT INTO beers (name, description, percent) VALUES (?, ?, ?)");
        return parent::insert($statement, [$beer->name, $beer->description, $beer->percent], $beer);
    }
    
    public function update($beer) {
        $statement = $this->db->prepare("UPDATE beers SET name = ?, description = ?, percent = ? WHERE id = ?");
        return parent::insert($statement, [$beer->name, $beer->description, $beer->percent, $beer->id], $beer);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Beer(
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["description"] ?? false,
            $data["percent"] ?? false,
            false
        );
    }
}