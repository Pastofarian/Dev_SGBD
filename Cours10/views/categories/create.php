<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   ?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Céer une catégorie</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="./CSS/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container">
         <h1>Créer une nouvelle catégorie</h1>
         <form action="categories.php?store=1" method="post">
            <div class="form-group">
               <label for="name">Nom:</label>
               <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
               <label for="recipes">Recettes:</label>
               <select class="form-control" id="recipes" name="recipes[]" multiple>
               <?php
                  foreach ($recipes as $recipe) {
                      echo "<option value='{$recipe->id}'>{$recipe->name}</option>";
                  }
                  ?>
               </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer une catégorie</button>
         </form>
      </div>
   </body>
</html>
