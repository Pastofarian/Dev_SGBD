<?php 

class RecipeController {
    
    public function index () {
        $recipes = Recipe::all();
        return include 'views/recipes/list.php';
    }
    
    public function show ($id) {
        $recipe = Recipe::find($id);
        if ($recipe) {
            return include 'views/recipes/one.php';
        }
        return include 'views/recipes/notfound.php';
    }
    
    public function create () {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return include 'views/recipes/create.php';
    }
    
    public function store ($data) {
        $category = Category::find($data["category_id"]);
        $recipe = new Recipe(false, $data["name"], $category);
        $recipe->save();
        foreach($data["ingredient_ids"] as $ingredient_id) {
            $recipe->add('ingredients', Ingredient::find($ingredient_id));
        }
        return include 'views/recipes/list.php';
    }
}