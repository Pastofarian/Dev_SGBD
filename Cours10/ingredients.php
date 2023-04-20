<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require('autoload.php');

$controller = new IngredientController();
if (!empty($_GET["store"])) {
    $controller->store($_POST);
} else if (!empty($_GET["id"])) {
    $controller->show($_GET["id"]);
} else if (!empty($_GET["create"])) {
    $controller->create();
} else {
    $controller->index();
}