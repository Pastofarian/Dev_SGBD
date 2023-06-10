<?php

class Student extends Entity {
    protected $id;
    protected $name;
    protected static $dao = "StudentDAO";
    
    public function __construct ($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
}