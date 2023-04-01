<?php

class Console {
    private $id;
    private $name;

    public function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
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