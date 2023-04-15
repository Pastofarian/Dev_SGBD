<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $recipeId = isset($_POST['id']) ? $_POST['id'] : null;
  $recipeName = isset($_POST['name']) ? $_POST['name'] : null;
 
  if ($recipeId && $recipeName) {
    $recipe = RecipeEntity::find($recipeId);

    $recipe->name = $recipeName;

    $recipe->save();

    header('Location: ../Views/recipeView.php');

  }
}


  