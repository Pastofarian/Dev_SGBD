<?php

class GuitarDAO extends DAO {

    public function __construct () {
        parent::__construct("guitars");
    }
    
    public function store ($guitar) {
        $statement = $this->db->prepare("INSERT INTO guitars (manufacturer, model, type) VALUES (?, ?, ?)");
        return parent::insert($statement, [$guitar->manufacturer, $guitar->model, $guitar->type], $guitar);
    }
    
    public function update($guitar) {
        $statement = $this->db->prepare("UPDATE guitars SET manufacturer = ?, model = ?, type = ? WHERE id = ?");
        return parent::insert($statement, [$guitar->manufacturer, $guitar->model, $guitar->type, $guitar->id], $guitar);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Guitar(
            $data["id"] ?? false,
            $data["manufacturer"] ?? false,
            $data["model"] ?? false,
            $data["type"] ?? false,
            false
        );
    }
}