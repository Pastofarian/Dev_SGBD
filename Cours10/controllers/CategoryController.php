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
        $categories = Category::all();
        return include 'views/categories/create.php';
    }
    
    public function store($data) {
        $category = new Category(false, $data["name"]);
        $category->save();
        
        $categories = Category::all();
        return include 'views/categories/list.php';
    }
    
    public function edit($id) {
        $category = Category::find($id);
        $recipes = Recipe::all();
        return include 'views/categories/edit.php';
    }
    
    public function update($data) {
        $category = Category::find($data["id"]);
        $category->name = $data["name"];
        $category->save();
    
        if (!empty($data["recipes"])) {
            foreach ($data["recipes"] as $recipe_id) {
                $recipe = Recipe::find($recipe_id);
                $recipe->category_id = $category->id;
                $recipe->save();
            }
        }
    }
    
    public function destroy($id) {
        $category = Category::find($id);
        $recipes = $category->recipes();
    
        // Set category_id to null for associated recipes before deleting the category
        foreach ($recipes as $recipe) {
            $recipe->category_id = null;
            $recipe->save();
        }
    
        $category->delete();
        $categories = Category::all();
        return include 'views/categories/list.php';
    }
    
    public function updateView($id) {
        $category = Category::find($id);
        $recipes = Recipe::all();
        include 'views/categories/update.php';
    }    
      
}