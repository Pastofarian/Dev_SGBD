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
      <title>Guitaristes</title>
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
         <h1>Guitaristes</h1>
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Groupe</th>
                  <th>Pays</th>
                  <th>Guitare</th>
                  <th>Update</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  if (!empty($guitarists)){   
                      foreach ($guitarists as $guitarist) {
                          $guitars = $guitarists->guitars;
                          if (is_array($guitars)) {
                              $guitarNames = array_map(function($guitar) {
                                  return $guitar->name;
                              }, $guitars);
                              $guitarList = implode(", ", $guitarNames);
                          } else {
                              $guitarList = "";
                          }                        
                          echo "<tr>";
                          echo "<td>" . $guitarist->id . "</td>";
                          echo "<td>" . $guitarist->name . "</td>";
                          echo "<td>" . $guitarist->band . "</td>";
                          echo "<td>" . $guitarist->country . "</td>";
                          echo "<td>" . $guitarList . "</td>";
                          echo "<td><a href='guitarists.php?updateView=" . $guitarist->id . "' class='btn custom-button'>Update</a></td>";                
                          echo "</td>";
                          echo "<td>
                              <form action='guitarists.php?destroy=1' method='post'>
                                  <input type='hidden' name='id' value='" . $guitarist->id . "'>
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
