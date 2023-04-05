<?php

class ConsoleDAO extends DAO {

    public function __construct () {
        parent::__construct("consoles");
    }
    
    public function store ($console) {
        $statement = $this->db->prepare("INSERT INTO consoles (name) VALUES (?)");
        return parent::insert($statement, [$console->name], $console);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Console(
            $data["id"] ?? false,
            $data["name"] ?? false,
        );
    }
}