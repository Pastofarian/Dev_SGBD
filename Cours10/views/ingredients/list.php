<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// require_once('../../autoload.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingrédients</title>
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
        <h1>Ingrédients</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Présent dans les recettes</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // $allIngredients = Ingredient::all();
                foreach ($ingredients as $ingredient) {
                    $recipes = $ingredient->recipes;
                    if (is_array($recipes)) {
                        $recipeNames = array_map(function($recipe) {
                            return $recipe->name;
                        }, $recipes);
                        $recipeList = implode(", ", $recipeNames);
                    } else {
                        $recipeList = "";
                    }
                    echo "<tr>";
                    echo "<td>" . $ingredient->id . "</td>";
                    echo "<td>" . $ingredient->name . "</td>";
                    echo "<td>" . $recipeList . "</td>";
                    echo "<td><a href='ingredients.php?updateView=" . $ingredient->id . "' class='btn custom-button'>Update</a></td>";                
                    echo "</td>";
                    echo "<td>
                        <form action='ingredients.php?destroy=1' method='post'>
                            <input type='hidden' name='id' value='" . $ingredient->id . "'>
                            <input type='submit' value='Delete' class='btn btn-danger'>
                        </form>
                    </td>";
                    echo "</tr>";
                }                
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
