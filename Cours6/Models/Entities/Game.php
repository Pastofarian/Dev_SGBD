<?php

require_once('Models/Entities/BaseEntity.php');

class Game extends BaseEntity {
    protected $id;
    protected $name;
    protected $type;
    protected static $dao = "GameDAO";
    
    public function __construct ($id, $name, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name} ({$this->type})";
    }

}