<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    if ($name) {
        $console = new Console(false, $name);
        $result = $console->saveStore();

        if ($result) {
            header('Location: ../Views/Consoles.php');
            exit;
        } else {
            echo "Un problème est survenu pendant la création de la console.";
        }
    } else {
        echo "Un nom est obligatoire.";
    }
} else {
    header('Location: ../Views/createConsole.php');
    exit;
}
