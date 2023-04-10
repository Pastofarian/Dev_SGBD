<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   require_once('../autoload.php');
   
   $TypeId = isset($_GET['id']) ? $_GET['id'] : null;
   
   if ($TypeId) {
     $type = Type::find($TypeId);
   } else {
     header("Location: Types.php");
     exit;
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Update Type</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="../CSS/background.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container">
         <h1>Update Type</h1>
         <form action="../Controllers/updateType_process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $type->id; ?>">
            <div class="form-group">
               <label for="name">Nom:</label>
               <input type="text" class="form-control" id="name" name="name" value="<?php echo $type->name; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update du type</button>
         </form>
      </div>
   </body>
</html>
