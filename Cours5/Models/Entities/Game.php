<?php

class Game {
    private $id;
    private $name;
    private $type;
    

    public function __construct ($id, $name, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;

    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
    
    public function __set ($prop, $value) {
        if (property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name} ({$this->type})";
    }
}