<?php

class Console extends Entity {
    protected $id;
    protected $name;
    
    public function __construct ($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name}";
    }
}

