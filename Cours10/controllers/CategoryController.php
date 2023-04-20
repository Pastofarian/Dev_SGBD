<?php 

class CategoryController {
    
    public function index () {
        $categories = Category::all();
        return include 'views/categories/list.php';
    }
    
    public function show ($id) {
        $category = Category::find($id);
        if ($category) {
            return include 'views/categories/one.php';
        }
        return include 'views/categories/notfound.php';
    }
    
    public function create () {
        $recipes = Recipe::all();   
        // $ingredients = Ingredient::all();
        return include 'views/categories/create.php';
    }
    
    public function store ($data) {
        $recipe = Recipe::find($data["recipe_id"]);
        $category = new Category(false, $data["name"], $recipe);
        $category->save();
        // foreach($data["ingredient_ids"] as $ingredient_id) {
        //     $recipe->add('ingredients', Ingredient::find($ingredient_id));
        // }
        
    }
}