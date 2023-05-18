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
      <title>Ajouter un guitariste</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="./CSS/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container">
         <h1>Ajouter un nouveau guitariste</h1>
         <form action="guitarists.php?store=1" method="post">
            <div class="form-group">
               <label for="name">Nom:</label>
               <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
               <label for="band">Groupe:</label>
               <input type="text" class="form-control" name="band" id="band" required>
            </div>
            <div class="form-group">
               <label for="country">Pays:</label>
               <input type="text" class="form-control" name="country" id="country" required>
            </div>
            <div class="form-group">
               <label for="guitar_id">Guitar:</label>
               <select class="form-control" id="guitar_id" name="guitar_id">
                  <?php
                     foreach ($guitars as $guitar): ?>
                  <option value="<?php echo $guitar->id; ?>">
                     <?php echo $guitar->name; ?>
                  </option>
                  <?php endforeach; ?>
               </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter un guitariste</button>
         </form>
      </div>
   </body>
</html>
