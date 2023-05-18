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
      <title>Update guitariste</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="./CSS/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container">
         <h1>Update guitarist</h1>
         <form action="guitarist.php?update=1" method="post">
            <input type="hidden" name="id" value="<?php echo $guitarist->id; ?>">
            <div class="form-group">
               <label for="name">Nom:</label>
               <input type="text" class="form-control" id="name" name="name" value="<?php echo $guitarist->name; ?>">
            </div>
            <div class="form-group">
               <label for="band">Groupe:</label>
               <input type="text" class="form-control" id="band" name="band" value="<?php echo $guitarist->band; ?>">
            </div>
            <div class="form-group">
               <label for="country">Groupe:</label>
               <input type="text" class="form-control" id="country" name="country" value="<?php echo $guitarist->country; ?>">
            </div>
            <div class="form-group">
               <label for="guitars">Guitares:</label>
               <select class="form-control" id="guitars" name="guitar_ids[]" multiple>
               <?php
                  $guitaristguitarIds = array_map(function($guitar) { return $guitar->id; }, $guitarist->guitars);
                  foreach ($guitars as $guitar) {
                    $selected = in_array($guitar->id, $guitaristguitarIds) ? 'selected' : '';
                    echo "<option value='{$guitar->id}' {$selected}>{$guitar->name}</option>";
                  }
                  ?>
               </select>
            </div>
            <button type="submit" class="btn btn-primary">Update du guitariste</button>
         </form>
      </div>
   </body>
</html>
