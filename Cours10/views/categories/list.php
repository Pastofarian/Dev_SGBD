<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//require_once('../../autoload.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include('./views/partials/header.php');
?>
    <div class="container">
        <h1>Catégories</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Recettes dans ces catégories</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                //$allCategory = Category::all();

                foreach ($categories as $category) {
                    if ($category->id == -1) { // on affiche pas si c'est la catégorie pas défaut
                        continue;
                    }
                    $recipes = $category->recipes;
                    $recipeNames = array_map(function($recipe) {
                        return $recipe->name;
                    }, $recipes);
                    $recipeList = implode(", ", $recipeNames);
                    echo "<tr>";
                    echo "<td>" . $category->id . "</td>";
                    echo "<td>" . $category->name . "</td>";
                    echo "<td>" . $recipeList . "</td>";
                    echo "<td><a href='updateCategoryView.php?id={$category->id}' class='btn custom-button'>Update</a></td>";
                    echo "<td><a href='../Controllers/deleteCategoryController.php?id={$category->id}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
