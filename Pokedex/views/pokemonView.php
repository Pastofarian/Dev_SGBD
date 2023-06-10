<!DOCTYPE html>
<html>
   <head>
      <title>Pokemons</title>
      <!-- CSS -->
      <link rel="stylesheet" href="./CSS/style.css">
      <!-- Google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
      <!-- bibliothèques jQuery et Bootstrap -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
      <!-- Début de modale ajout -->
      <div class="modal fade" id="myModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title">Pokemon ajouté</h4>
                  <!-- Bouton de fermeture de modale -->
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  Pokemon <span id="pokemonName"></span> a été ajouté à vos favoris.
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Fin de modale ajout -->
      <!-- Début de modale suppression -->
      <div class="modal fade" id="removeModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title">Pokemon retiré de la base de données</h4>
                  <!-- Bouton de fermeture de modale -->
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  Pokemon <span id="removePokemonName"></span> a été retiré de vos favoris.
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Fin de modale suppression -->
      <a href="pokemons.php?list=1" class="button-link">Liste complète des Pokémons</a>
      <h1>Pokemons Favoris</h1>
      <table border='1'>
         <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Sprite</th>
            <th>Types</th>
            <th>Compétences</th>
            <th>Action</th>
         </tr>
         <?php foreach($favPokemons as $pokemon): ?>
         <tr>
            <td><?php echo $pokemon->id; ?></td>
            <td><?php echo $pokemon->name; ?></td>
            <td><img src='<?php echo $pokemon->sprite; ?>' alt='<?php echo $pokemon->name; ?>' /></td>
            <td>
               <?php 
                  //$pokemon->type = json_decode($pokemon->type);
                  foreach($pokemon->type as $type) {
                      echo $type . " ";
                  }
                  ?>
            </td>
            <td>
               <!-- Bouton pour afficher/masquer les compétences du pokemon -->
               <button class="btn btn-primary action-button" type="button" data-toggle="collapse" data-target="#moves<?php echo $pokemon->id; ?>" aria-expanded="false" aria-controls="moves<?php echo $pokemon->id; ?>">
               Afficher/Masquer Compétences
               </button>
               <!-- Début des compétences -->
               <div class="collapse" id="moves<?php echo $pokemon->id; ?>">
                  <div class="card card-body">
                     <?php 
                        //$pokemon->moves = json_decode($pokemon->moves);
                        foreach($pokemon->moves as $move) {
                           //json_decode($pokemon->moves);
                           echo $move . " ";
                        }
                        ?>
                  </div>
               </div>
            </td>
            <!-- Bouton pour retirer le pokemon des favoris -->
            <td><button class='remove-pokemon action-button' data-id='<?php echo $pokemon->id; ?>'>Retirer des favoris</button></td>
         </tr>
         <?php endforeach; ?>
      </table>
      <!-- Fin du tableau des pokemons favoris -->
      <!-- Début du bandeau de pokemons -->
      <div class="pokemon-banner">
         <div class="pokemon-card">
            <img id="pokemonImage1" src="" alt="pokemon">
            <h2 id="pokemonName1"></h2>
            <button class="add-to-favorites" id="addToFavorites1">Ajouter aux favoris</button>
         </div>
         <div class="pokemon-card">
            <img id="pokemonImage2" src="" alt="pokemon">
            <h2 id="pokemonName2"></h2>
            <button class="add-to-favorites" id="addToFavorites2">Ajouter aux favoris</button>
         </div>
         <div class="pokemon-card">
            <img id="pokemonImage3" src="" alt="pokemon">
            <h2 id="pokemonName3"></h2>
            <button class="add-to-favorites" id="addToFavorites3">Ajouter aux favoris</button>
         </div>
      </div>
      <!-- Fin du bandeau des pokemons -->
      <!-- Pokemons disponibles depuis l'API -->
      <h1>Pokemons Disponible(api)</h1>
      <?php
         error_reporting(E_ALL);
         ini_set('display_errors', 1);
         ini_set('display_startup_errors', 1);
            $api_url = 'https://pokeapi.co/api/v2/pokemon';
            $response = file_get_contents($api_url);
            $data = json_decode($response, true);
            
            // Récupére et affiche des Pokemons de l'API
            $apiPokemons = [];
            foreach ($data['results'] as $key => $pokemon) {
                $pokemon_url = $pokemon['url'];
                $pokemon_data = json_decode(file_get_contents($pokemon_url), true);
            
                $pokemon_moves = array_map(function($move) {
                    return $move['move']['name'];
                }, $pokemon_data['moves']);
            
                $pokemon_types = array_map(function($type) {
                    return $type['type']['name'];
                }, $pokemon_data['types']);
            
                // Création de l'objet Pokemon
                $apiPokemon = new Pokemon(
                    $pokemon_data['id'],
                    $pokemon_data['name'],
                    $pokemon_data['sprites']['front_default'],
                    $pokemon_moves,
                    $pokemon_types
                );
            
                // Ajout du Pokemon à la liste des Pokemons
                $apiPokemons[] = $apiPokemon;
            }
            //En html ça foirait alors j'ai tout fait en php
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Name</th><th>Sprite</th><th>Types</th><th>Compétences</th><th>Action</th></tr>";
            
            foreach($apiPokemons as $pokemon):
                echo "<tr>";
                echo "<td>{$pokemon->id}</td>";
                echo "<td>{$pokemon->name}</td>";
                echo "<td><img src='{$pokemon->sprite}' alt='{$pokemon->name}' /></td>";
                echo "<td>";
                foreach($pokemon->type as $type) {
                    echo $type . " ";
                }
                echo "</td>";
                echo "<td>";
                echo "<button class='btn btn-primary action-button' type='button' data-toggle='collapse' data-target='#apiMoves{$pokemon->id}' aria-expanded='false' aria-controls='apiMoves{$pokemon->id}'>
                      Afficher/Masquer Compétences
                    </button>";
                echo "<div class='collapse' id='apiMoves{$pokemon->id}'>
                      <div class='card card-body'>";
                foreach($pokemon->moves as $move) {
                    echo $move . " ";
                }
                echo "</div></div></td>";
                echo "<td><button class='add-pokemon action-button' data-id='{$pokemon->id}'>Ajouter aux favoris</button></td>";
                echo "</tr>";
            endforeach;
            
            echo "</table>";
            ?>
      <script>
         $(document).ready(function(){
             // Event listener pour l'ajout d'un Pokemon aux favoris
             $(".add-pokemon").click(function(){
             var pokemonId = $(this).data('id'); 
         
            $.get('https://pokeapi.co/api/v2/pokemon/'+pokemonId)
            .done(function(results) {
                let name = results.name;
                let sprite = results.sprites.front_default;
                let types = results.types;
                let moves = results.moves;
               // console.log(name);
               // console.log(sprite);
               // console.log(types);
               // console.log(stringify(moves));
               $.ajax({
         url: 'pokemons.php?store=1', 
         type: 'post',
         data: {
         name: name, 
         sprite: sprite, 
         types: JSON.stringify(types.map(type => type.type.name)), 
         moves: JSON.stringify(moves.map(move => move.move.name))
         },
         success: function(response) {
         $('#pokemonName').text(response); 
         $('#myModal').modal('show'); 
         location.reload();
         },
         error: function(jqXHR, textStatus, errorThrown) {
         alert('Error: ' + jqXHR.responseText);
         }
         });
         
            }).fail(function(err) {
                        console.warn('error is', err);
                    });
         });
         
         //Delete
                     $(".remove-pokemon").click(function(){
               var pokemonId = $(this).data('id'); 
               $.ajax({
                  url: 'pokemons.php?destroy=1', 
                  type: 'post',
                  data: {id: pokemonId},
                  success: function(response) { 
                        $('#removePokemonName').text(response);
                        $('#removeModal').modal('show'); 
                        location.reload();
                  },
                  error: function(jqXHR, textStatus, errorThrown) { 
                        alert('Error: ' + jqXHR.responseText);
                  }
               });
            });
         });
         
         // function stringify(arr){
         //    let string = '[';
         //    for(let i in arr){
         //       if(i < arr.length - 1){
         //          string += '"'+ arr[i].move.name +'",';
         //       } else {
         //          string += '"'+ arr[i].move.name +'"';
         //       }
         //    }
         //    //console.log(string + "]");
         //    return string + ']';
         // }
         
         //Bannière
         // On récupère un random Pokemon depuis l'API et l'affiche
         function fetchRandomPokemon(cardId) {
             var randomId = Math.floor(Math.random() * 1000) + 1;
             
         // L'appel AJAX récupère les données du Pokemon et met à jour l'image et le nom
             $.ajax({
                 url: 'https://pokeapi.co/api/v2/pokemon/' + randomId,
                 method: 'GET',
                 success: function(data) {
                     $('#pokemonImage' + cardId).attr('src', data.sprites.front_default);
                     $('#pokemonName' + cardId).text(data.name);
                     $('#addToFavorites' + cardId).data('id', data.id);
                 },
                 error: function() {
                     console.log('Error fetching data');
                 }
             });
         }
         
         // Initialisation des cartes avec des Pokemons aléatoires
         fetchRandomPokemon(1);
         fetchRandomPokemon(2);
         fetchRandomPokemon(3);
         
         setInterval(function(){
             fetchRandomPokemon(1);
             fetchRandomPokemon(2);
             fetchRandomPokemon(3);
         }, 5000);
      </script>
   </body>
</html>
