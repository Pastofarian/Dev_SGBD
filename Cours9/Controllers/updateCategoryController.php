<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $categoryId = isset($_POST['id']) ? $_POST['id'] : null;
  $categoryName = isset($_POST['name']) ? $_POST['name'] : null;
 
  if ($categoryId && $categoryName) {
    $category = CategoryEntity::find($categoryId);

    $category->name = $categoryName;

    $category->save();

    header('Location: ../Views/categoryView.php');

  }
}


  