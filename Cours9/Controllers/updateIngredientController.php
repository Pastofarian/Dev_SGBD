<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ingredientId = isset($_POST['id']) ? $_POST['id'] : null;
  $ingredientName = isset($_POST['name']) ? $_POST['name'] : null;
 
  if ($ingredientId && $ingredientName) {
    $ingredient = IngredientEntity::find($ingredientId);

    $ingredient->name = $ingredientName;

    $ingredient->save();

    header('Location: ../Views/ingredientView.php');

  }
}


  