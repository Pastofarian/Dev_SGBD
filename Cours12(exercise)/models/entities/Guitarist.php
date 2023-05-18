<?php

class Guitarist extends Entity {
    protected $id;
    protected $name;
    protected $band;
    protected $country;
    protected $guitars;
    protected static $dao = "GuitaristDAO";
    
    public function __construct ($id, $name, $band, $country, $guitars = false) {
        $this->id = $id;
        $this->name = $name;
        $this->band = $band;
        $this->country = $country;
        $this->guitars = $guitars;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "guitars") {
                return $this->guitars();
            }
            return $this->$prop;
        }
    }
    
    public function guitars () {
        return $this->belongsToMany(Guitar::class, "guitars", "guitar_guitarist", "guitarist_id", "guitar_id");
    }
    
    public function remove ($prop, $guitar = false) {
        if ($prop == "guitars") {
            return $this->unsync("guitar_guitarist", "guitarist_id", "guitar_id", $guitar);
        }
    }
    
    public function add ($prop, $guitar) {
        if ($prop == "guitars") {
            return $this->sync("guitar_guitarist", "guitarist_id", "guitar_id", $guitar);
        }
    }
}