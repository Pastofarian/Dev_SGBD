<?php

class Beer extends Entity {
    protected $id;
    protected $name;
    protected $description;
    protected $percent;
    protected $bars;
    protected static $dao = "BeerDAO";
    
    public function __construct ($id, $name, $description, $percent, $bars = false) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->percent = $percent;
        $this->bars = $bars;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "bars") {
                return $this->bars();
            }
            return $this->$prop;
        }
    }
    
    public function bars () {
        return $this->belongsToMany(Bar::class, "bars", "bar_beer", "beer_id", "bar_id");
    }
    
    public function remove ($prop, $bar = false) {
        if ($prop == "bars") {
            return $this->unsync("bar_beer", "beer_id", "bar_id", $bar);
        }
    }
    
    public function add ($prop, $bar) {
        if ($prop == "bars") {
            return $this->sync("bar_beer", "beer_id", "bar_id", $bar);
        }
    }
}