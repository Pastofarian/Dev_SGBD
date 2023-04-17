<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    if ($name) {
        $ingredient = new IngredientEntity(false, $name);
        $result = $ingredient->save();
// echo "<pre>";
// var_dump($ingredient);
// echo "</pre>";
// echo $name; 
// echo "<br>";

        if ($result) {
            // Redirige vers ingredient si ok
            header('Location: ../Views/ingredientView.php');
            exit;
        } else {
            echo "Un problème est survenu pendant la création de l'ingrédient.";
        }
    } else {
        echo "Un nom est obligatoire.";
    }
} else {
    // redirige vers createIngredientView si la REQUEST_METHOD n'est pas POST
    header('Location: ../Views/createIngredientView.php');
    exit;
}
