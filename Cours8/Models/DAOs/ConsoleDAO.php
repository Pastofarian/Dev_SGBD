<?php

class ConsoleDAO extends BaseDAO {

    public function __construct() {
        parent::__construct('consoles');
    }

    public function createEntity ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Console(
            $data["id"] ?? false,
            $data["name"] ?? false,
            false
        );
    }

    public function store ($console) {
        $statement = $this->db->prepare("INSERT INTO consoles (name) VALUES (?)");
        return parent::insertStore($statement, [$console->name], $console);
    }

    public function update($console) {
        $statement = $this->db->prepare("UPDATE consoles SET name = ? WHERE id = ?");
        return parent::insertUpdate($statement, [$console->name, $console->id], $console);
    }

}