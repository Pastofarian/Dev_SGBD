<?php

class BarDAO extends DAO {

    public function __construct () {
        parent::__construct("bars");
    }
    
    public function store ($bar) {
        $statement = $this->db->prepare("INSERT INTO bars (name, address, owner) VALUES (?, ?, ?)");
        return parent::insert($statement, [$bar->name, $bar->address, $bar->owner], $bar);
    }
    
    public function update($bar) {
        $statement = $this->db->prepare("UPDATE bars SET name = ?, address = ?, owner = ? WHERE id = ?");
        return parent::insert($statement, [$bar->name, $bar->address, $bar->owner, $bar->id], $bar);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Bar(
            $data["id"] ?? false,
            $data["name"] ?? false,
            $data["address"] ?? false,
            $data["owner"] ?? false,
            false
        );
    }
}