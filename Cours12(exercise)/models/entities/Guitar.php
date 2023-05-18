<?php

class Guitar extends Entity {
    protected $id;
    protected $manufacturer;
    protected $model;
    protected $type;
    protected $guitarists;
    protected static $dao = "GuitarDAO";
    
    public function __construct ($id, $manufacturer, $model, $type, $guitarists = false) {
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->type = $type;
        $this->guitarists = $guitarists;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "guitarists") {
                return $this->guitarists();
            }
            return $this->$prop;
        }
    }
    
    public function owners () {
        return $this->belongsToMany(Guitarist::class, "guitarists", "guitar_guitarist", "guitar_id", "guitarist_id");
    }
    
    public function remove ($prop, $guitarist = false) {
        if ($prop == "guitarists") {
            return $this->unsync("guitar_beer", "guitar_id", "guitarist_id", $guitarist);
        }
    }
    
    public function add ($prop, $guitarist) {
        if ($prop == "guitarists") {
            return $this->sync("guitar_guitarist", "guitar_id", "guitarist_id", $guitarist);
        }
    }
}