<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   require 'autoload.php';
   
   $my_beer = Beer::find(1);
   $my_bar = Bar::find(1);
   //$my_beer->remove('bars');
   // print_r($my_beer);
   // print_r($my_bar);
   
   // On vérifie d'abord si la requête provient d'un appel AJAX.
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
   
    // Si l'objet de la requête est une bière.
    if ($_POST['type'] == 'beer') {
        // On cherche la bière par son identifiant.
        $beer = Beer::find($_POST['id']);
        // On crée une réponse avec les détails de la bière.
        $response = [
            'name' => $beer->name,
            'description' => $beer->description,
            'percent' => $beer->percent,
        ];
        // On renvoie la réponse en format JSON.
        echo json_encode($response);
        exit();
    }
    
    // Si l'objet de la requête est un bar.
    if ($_POST['type'] == 'bar') {
        // On cherche le bar par son identifiant.
        $bar = Bar::find($_POST['id']);
        // On crée une réponse avec les détails du bar.
        $response = [
            'name' => $bar->name,
            'address' => $bar->address,
            'owner' => $bar->owner,
        ];
        // On renvoie la réponse en format JSON.
        echo json_encode($response);
        exit();
    }
   }
   
   // Si la requête ne provient pas d'un appel AJAX, on récupère toutes les bières et tous les bars pour les afficher sur la page.
   $beers = Beer::all();
   $bars = Bar::all();
   
   
   // echo "test";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"
         integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
      <title>Document</title>
      <style>
         #beer_details, #bar_details {
         margin-top: 50px; 
         margin-bottom: 50px; 
         }
      </style>
   </head>
   <body>
      <h4>Dans le projet BeerBar => Au clic d’une bière/d’un bar, aller chercher sa page avec une
         requête ajax
      </h4>
      <!-- Beers -->
      <?php foreach ($beers as $beer): ?>
      <div class="beer" data-id="<?= $beer->id ?>"><?= $beer->name ?></div>
      <?php endforeach; ?>
      <!-- Beer details -->
      <div id="beer_details"></div>
      <!-- Bars -->
      <?php foreach ($bars as $bar): ?>
      <div class="bar" data-id="<?= $bar->id ?>"><?= $bar->name ?></div>
      <?php endforeach; ?>
      <!-- Bar details -->
      <div id="bar_details"></div>
      <script>
         // On attend que la page soit complètement chargée.
         $(document).ready(function() {
             // Lorsqu'on clique sur un élément avec la classe 'beer'.
             $('.beer').click(function() {
                 // On récupère l'identifiant de la bière.
                 var beerId = $(this).data('id');
                 // On fait une requête AJAX à 'index.php'.
                 $.ajax({
                     url: 'index.php', 
                     type: 'POST',
                     data: { 
                         id: beerId,
                         type: 'beer'
                     },
                     // En cas de succès de la requête.
                     success: function(response) {
                         // On interprète la réponse JSON.
                         var beer = JSON.parse(response);
                         // On affiche les détails de la bière dans l'élément avec l'id 'beer_details'.
                         $('#beer_details').html('Beer name: ' + beer.name + '<br>' + 
                                             'Description: ' + beer.description + '<br>' +
                                             'Alcohol: ' + beer.percent + '%');
                     },
                     // En cas d'erreur dans la requête.
                     error: function() {
                         // On affiche une alerte.
                         alert('Error fetching beer details');
                     }
                 });
             });
         
             // La même chose se produit pour un élément avec la classe 'bar', mais pour les bars.
             $('.bar').click(function() {
                 var barId = $(this).data('id');
                 $.ajax({
                     url: 'index.php', 
                     type: 'POST',
                     data: { 
                         id: barId,
                         type: 'bar'
                     },
                     success: function(response) {
                         var bar = JSON.parse(response);
                         $('#bar_details').html('Bar name: ' + bar.name + '<br>' + 
                                         'Address: ' + bar.address + '<br>' +
                                         'Owner: ' + bar.owner);
                     },
                     error: function() {
                         alert('Error fetching bar details');
                     }
                 });
             });
         });
         
               
      </script>
   </body>
</html>
