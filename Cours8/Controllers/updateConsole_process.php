<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $consoleId = isset($_POST['id']) ? $_POST['id'] : null;
  $consoleName = isset($_POST['name']) ? $_POST['name'] : null;
 
  if ($consoleId && $consoleName) {
    $console = Console::find($consoleId);

    $console->name = $consoleName;

    $console->save();

    header('Location: ../Views/Consoles.php');

  }
}


  