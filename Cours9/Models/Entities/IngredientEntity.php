<?php

class IngredientEntity extends Entity {
    protected $id;
    protected $name;
    protected $recipes;
    protected static $dao = "IngredientDao";
    
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
            $this->recipes = $this->belongsToMany(RecipeEntity::class, "recipes", "ingredientRecipe", "ingredient_id", "recipe_id");
        }
        return $this->recipes ?: [];
    }
}
