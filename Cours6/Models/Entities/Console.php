<?php

class Console extends BaseEntity {
    protected $id;
    protected $name;
    protected $games;
    protected static $dao = "ConsoleDAO";
    
    public function __construct ($id, $name, $games = false) {
        $this->id = $id;
        $this->name = $name;
        $this->games = $games;
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name}";
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "games") {
                return $this->games();
            }
            return $this->$prop;
        }
    }
    
    public function games () {
        return $this->belongsToMany(Game::class, "games", "console_game", "console_id", "game_id");
    }
}