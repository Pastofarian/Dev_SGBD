<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    if ($name) {
        $category = new CategoryEntity(false, $name);
        $result = $category->save();

        if ($result) {
            header('Location: ../Views/categoryView.php');
            exit;
        } else {
            echo "Un problème est survenu pendant la création de la catégorie.";
        }
    } else {
        echo "Un nom est obligatoire.";
    }
} else {
    header('Location: ../Views/createCategoryView.php');
    exit;
}
