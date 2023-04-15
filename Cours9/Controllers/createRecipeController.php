<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('../autoload.php');
//session_start();
//$_SESSION["categories"] = CategoryEntity::all();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : '';

    if ($name && $category_id) {
        $recipe = new RecipeEntity(false, $name, $category_id);
        $result = $recipe->save();

        if ($result) {
            header('Location: ../Views/recipeView.php');
            exit;
        } else {
            echo "Un problème est survenu pendant la création de la recette.";
        }
    } else {
        echo "Un nom et un ID de catégorie sont obligatoires.";
    }
} else {
    header('Location: ../Views/createRecetteView.php');
    exit;
}

