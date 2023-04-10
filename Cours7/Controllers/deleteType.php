<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

$typeId = isset($_GET['id']) ? $_GET['id'] : null;
echo $typeId;

if ($typeId) {
    $type = Type::find($typeId);
    if ($type) {
        $type->delete($typeId);
    }
}


header('Location: ../Views/Types.php');
exit;
