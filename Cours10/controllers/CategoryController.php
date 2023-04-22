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
    
    
    
}