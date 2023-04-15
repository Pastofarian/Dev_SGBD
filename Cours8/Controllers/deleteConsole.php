<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

$consoleId = isset($_GET['id']) ? $_GET['id'] : null;
echo $consoleId;

if ($consoleId) {
    $console = Console::find($consoleId);
    if ($console) {
        $console->delete($consoleId);
    }
}


header('Location: ../Views/Consoles.php');
exit;
