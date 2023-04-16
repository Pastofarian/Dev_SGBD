<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newIngredientIds = isset($_POST['ingredients']) ? $_POST['ingredients'] : [];
  $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : null;
  $recipeId = isset($_POST['id']) ? $_POST['id'] : null;
  $recipeName = isset($_POST['name']) ? $_POST['name'] : null;
 
  if ($recipeId && $recipeName && $categoryId) {
    $recipe = RecipeEntity::find($recipeId);

    $recipe->name = $recipeName;
    $recipe->category_id = $categoryId;

    $recipe->save();

    // On retire les anciens et on rajoute les nouveaux ingrédients
    $recipe->removeIngredients($recipeId);
    foreach ($newIngredientIds as $ingredientId) {
      $recipe->addIngredient($recipeId, $ingredientId);
    }

    header('Location: ../Views/recipeView.php');
  }
}

  