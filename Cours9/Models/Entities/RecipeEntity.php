<?php

class RecipeEntity extends Entity {
    protected $id;
    protected $name;
    protected $category_id;
    protected $category;
    protected $ingredients;
    protected static $dao = "RecipeDao";
    
    public function __construct($id, $name, $category_id, $category = null, $ingredients = false) {
        $this->id = $id;
        $this->name = $name;
        $this->category_id = $category_id;
        $this->category = $category;
        $this->ingredients = $ingredients;
    }
    
    public function __toString() {
        return "{$this->id} : {$this->name}";
    }
    
    public function __get($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "category") {
                return $this->category();
            }
            if ($prop == "ingredients") {
                return $this->ingredients();
            }
            return $this->$prop;
        }
    }
    
    public function category() {
        if ($this->category === false) {
            $this->category = $this->belongsTo(CategoryEntity::class, "category_id");
        }
        return $this->category;
    }    
    
    public function ingredients() {
        if ($this->ingredients === false) {
            $this->ingredients = $this->belongsToMany(IngredientEntity::class, "ingredients", "ingredientRecipe", "recipe_id", "ingredient_id");
        }
        return $this->ingredients ?: []; // Retourne un tableau vide si il n'y a pas d'ingrédients
    }
    
}
