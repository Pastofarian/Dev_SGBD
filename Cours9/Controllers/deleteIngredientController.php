<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

$ingredientId = isset($_GET['id']) ? $_GET['id'] : null;

if ($ingredientId) {
    $ingredient = IngredientEntity::find($ingredientId);
    if ($ingredient) {
        $ingredient->delete($ingredientId);
    }
}

header('Location: ../Views/ingredientView.php');
exit;
