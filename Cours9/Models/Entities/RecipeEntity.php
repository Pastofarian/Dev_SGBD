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
        if ($this->category === null) {
            // Replace with the actual method used in your application to fetch the related Category object
            $this->category = $this->belongsTo(Category::class, "category_id");
        }
        return $this->category;
    }
    
    public function ingredients() {
        if ($this->ingredients === false) {
            // Replace with the actual method used in your application to fetch the related Ingredient objects
            $this->ingredients = $this->belongsToMany(Ingredient::class, "ingredients", "IngredientRecipe", "recipe_id", "ingredient_id");
        }
        return $this->ingredients;
    }
}
