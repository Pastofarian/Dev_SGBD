<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header('Location: ./guitarists.php');
exit;

/*
require('autoload.php');

$my_guitarist = Guitarist::find(1);
$my_guitar = Guitar::find(1);
echo "<pre>";
print_r($my_guitarist);
echo "</pre>";
echo "<pre>";
print_r($my_guitar);
echo "</pre>";

/*
require('autoload.php');

$guitarController = new GuitarController();
$guitaristController = new GuitaristController();

// Test GuitarController::index()
$guitars = $guitarController->index();
echo "<pre>";
print_r($guitars);
echo "</pre>";

// Test GuitarController::show()
$guitar = $guitarController->show(1);
echo "<pre>";
print_r($guitar);
echo "</pre>";

// Test GuitarController::create()
$guitarController->create();

// Test GuitarController::store()
$newGuitar = [
    "manufacturer" => "Gibson",
    "model" => "Les Paul",
    "type" => "Electric"
];
$guitarController->store($newGuitar);

// Test GuitarController::edit()
$guitarController->edit(1);

// Test GuitarController::update()
$updatedGuitar = [
    "id" => 1,
    "manufacturer" => "Fender",
    "model" => "Stratocaster",
    "type" => "Electric"
];
$guitarController->update($updatedGuitar);

// Test GuitarController::destroy()
$guitarController->destroy(1);

// Test GuitaristController::index()
$guitarists = $guitaristController->index();
echo "<pre>";
print_r($guitarists);
echo "</pre>";

// Test GuitaristController::show()
$guitarist = $guitaristController->show(1);
echo "<pre>";
print_r($guitarist);
echo "</pre>";

// Test GuitaristController::create()
$guitaristController->create();

// Test GuitaristController::store()
$newGuitarist = [
    "name" => "Eric Clapton",
    "band" => "Cream",
    "country" => "United Kingdom"
];
$guitaristController->store($newGuitarist);

// Test GuitaristController::edit()
$guitaristController->edit(1);

// Test GuitaristController::update()
$updatedGuitarist = [
    "id" => 1,
    "name" => "Jimi Hendrix",
    "band" => "The Jimi Hendrix Experience",
    "country" => "United States"
];
$guitaristController->update($updatedGuitarist);

// Test GuitaristController::destroy()
$guitaristController->destroy(1);
*/