<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   require_once('../autoload.php');
   
   $gameId = isset($_GET['id']) ? $_GET['id'] : null;
   
   if ($gameId) {
     $game = Game::find($gameId);
     $gameType = $game->getType();
   } else {
     header("Location: Games.php");
     exit;
   }
   $types = Type::all();
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Update Game</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="../CSS/background.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container">
         <h1>Update Game</h1>
         <form action="../Controllers/updateGame_process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $game->id; ?>">
            <div class="form-group">
               <label for="name">Name:</label>
               <input type="text" class="form-control" id="name" name="name" value="<?php echo $game->name; ?>">
            </div>
            <div class="form-group">
               <label for="type">Type:</label>
               <input type="hidden" name="type_id" id="type_id" value="<?php echo $gameType->id; ?>">
               <select class="form-control" id="type_select" name="type_select">
                  <?php foreach ($types as $type): ?>
                  <option value="<?php echo $type->id; ?>" <?php echo ($type->id === $gameType->id) ? 'selected' : ''; ?>>
                     <?php echo $type->name; ?>
                  </option>
                  <?php endforeach; ?>
               </select>
            </div>
            <script>
               document.getElementById('type_select').addEventListener('change', function() {
               document.getElementById('type_id').value = this.value;
               });
            </script>
            <button type="submit" class="btn btn-primary">Update Game</button>
         </form>
      </div>
   </body>
</html>
