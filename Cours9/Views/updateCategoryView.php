<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   require_once('../autoload.php');
   
   //Devrait être dans le Controller !
   $categoryId = isset($_GET['id']) ? $_GET['id'] : null;
   
   if ($categoryId) {
     $category = CategoryEntity::find($categoryId);
   } else {
     header("Location: categoryView.php");
     exit;
   }
   
   ?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Update category</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="../CSS/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container">
         <h1>Update catégorie</h1>
         <form action="../Controllers/updateCategoryController.php" method="post">
            <input type="hidden" name="id" value="<?php echo $category->id; ?>">
            <div class="form-group">
               <label for="name">Nom:</label>
               <input type="text" class="form-control" id="name" name="name" value="<?php echo $category->name; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update de la catégorie</button>
         </form>
      </div>
   </body>
</html>
