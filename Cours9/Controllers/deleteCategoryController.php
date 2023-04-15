<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

$categoryId = isset($_GET['id']) ? $_GET['id'] : null;
// echo $categoryId;
// echo "test";

if ($categoryId) {
    $category = CategoryEntity::find($categoryId);
    if ($category) {
        $category->delete($categoryId);
    }
}


header('Location: ../Views/categoryView.php');
exit;
