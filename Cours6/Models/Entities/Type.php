<?php

class Type extends BaseEntity {
    protected $id;
    protected $name;
    protected $games;

    protected static $dao = "TypeDAO";
    
    public function __construct ($id, $name, $games) {
        $this->id = $id;
        $this->name = $name;
        $this->games = $games;
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name}";
    }
}