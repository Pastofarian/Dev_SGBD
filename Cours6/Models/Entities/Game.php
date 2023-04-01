<?php

require_once('Models/Entities/BaseEntity.php');

class Game extends Entity {
    protected $type;
    
    public function __construct ($id, $name, $type) {
        parent::__construct($id, $name);
        $this->type = $type;
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name} ({$this->type})";
    }
}