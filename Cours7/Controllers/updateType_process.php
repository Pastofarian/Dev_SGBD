<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $typeId = isset($_POST['id']) ? $_POST['id'] : null;
  $typeName = isset($_POST['name']) ? $_POST['name'] : null;
 
  if ($typeId && $typeName) {
    $type = Type::find($typeId);

    $type->name = $typeName;

    $type->saveUpdate();

    header('Location: ../Views/Types.php');

  }
}


  