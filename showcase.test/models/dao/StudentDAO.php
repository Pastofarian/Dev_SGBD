<?php

class StudentDAO extends DAO {

    public function __construct () {
        parent::__construct("students");
    }
    
    public function store ($student) {
        $statement = $this->db->prepare("INSERT INTO students (name) VALUES (?)");
        return parent::insert($statement, [$student->name], $student);
    }
    
    public function update($student) {
        $statement = $this->db->prepare("UPDATE students SET name = ? WHERE id = ?");
        return parent::insert($statement, [$student->name, $student->id], $student);
    }
    
    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Student(
            $data["id"] ?? false,
            $data["name"] ?? false
        );
    }
}