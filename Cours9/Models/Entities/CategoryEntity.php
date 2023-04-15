<?php

class CategoryEntity extends Entity {
    protected $id;
    protected $name;
    protected $recipes;
    protected static $dao = "CategoryDao";
    
    public function __construct($id, $name, $recipes = false) {
        $this->id = $id;
        $this->name = $name;
        $this->recipes = $recipes;
    }
    
    public function __toString() {
        return "{$this->id} : {$this->name}";
    }
    
    public function __get($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "recipes") {
                return $this->recipes();
            }
            return $this->$prop;
        }
    }
    
    public function recipes() {
        if ($this->recipes === false) {
            $this->recipes = $this->hasMany(RecipeEntity::class, "recipes", "category_id");
        }
        return $this->recipes ?: []; // Retourne un tableau vide si il n'y a pas de recette
    }
    
}
