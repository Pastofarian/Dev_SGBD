<?php

class Type extends BaseEntity {
    protected $id;
    protected $name;
    protected $games;
    protected static $dao = "TypeDAO";
    
    public function __construct ($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->games = null; //pareil que dans Game
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name}";
    }
    
    public function getGames() {
        if ($this->games === null) {
            $this->games = Game::where('type_id', $this->id);
        }
        return $this->games;
    }
}