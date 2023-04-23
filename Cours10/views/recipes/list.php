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
    <title>Recettes</title>
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
        <h1>Recettes</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Catégorie</th>
                    <th>Nom</th>
                    <th>Ingredients</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // $recipes = Recipe::all();
                if (!empty($recipes)){   
                    foreach ($recipes as $recipe) {
                        $ingredients = $recipe->ingredients;
                        if (is_array($ingredients)) {
                            $ingredientNames = array_map(function($ingredient) {
                                return $ingredient->name;
                            }, $ingredients);
                            $ingredientList = implode(", ", $ingredientNames);
                        } else {
                            $ingredientList = "";
                        }                        
                        echo "<tr>";
                        echo "<td>" . $recipe->id . "</td>";
                        echo "<td>" . $recipe->category->name . "</td>";
                        echo "<td>" . $recipe->name . "</td>";
                        echo "<td>" . $ingredientList . "</td>";
                        echo "<td><a href='recipes.php?updateView=" . $recipe->id . "' class='btn custom-button'>Update</a></td>";                
                        echo "</td>";
                        echo "<td>
                            <form action='recipes.php?destroy=1' method='post'>
                                <input type='hidden' name='id' value='" . $recipe->id . "'>
                                <input type='submit' value='Delete' class='btn btn-danger'>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
