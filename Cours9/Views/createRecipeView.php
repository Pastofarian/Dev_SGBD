<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//include '../Controllers/createRecipeController.php';

//session_start();
//$categories = $_SESSION["categories"];
//devrait être dans mon controller
require_once('../autoload.php');
$categories = CategoryEntity::all();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une recette</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Créer un nouvelle recette</h1>
    <form action="../Controllers/createRecipeController.php" method="post">
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie:</label>
            <select class="form-control" id="category_id" name="category_id">
                <?php
                foreach ($categories as $category): ?>
                <option value="<?php echo $category->id; ?>">
                    <?php echo $category->name; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer une recette</button>
    </form>
</div>
</body>
</html>
