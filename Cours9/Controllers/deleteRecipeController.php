<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

$recipeId = isset($_GET['id']) ? $_GET['id'] : null;

if ($recipeId) {
    $recipe = RecipeEntity::find($recipeId);
    if ($recipe) {
        $recipe->delete($recipeId);
    }
}

header('Location: ../Views/recipeView.php');
exit;
