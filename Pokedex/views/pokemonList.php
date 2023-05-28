<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   
   require('../autoload.php');
   
   $dao = new PokemonDAO();
   $favPokemons = $dao->fetch_all();
   
   // classe les favoris par nom
   usort($favPokemons, function($a, $b) {
      return strcmp($a->name, $b->name);
   });
   
   // On fait un tableau avec les noms des favoris
   $favPokemonNames = array_map(function($pokemon) {
    return strtolower($pokemon->name);
   }, $favPokemons);
   
   // On convertis le tableau en Json pour le JS
   $jsonFavPokemonNames = json_encode($favPokemonNames);
   
   //    echo "<pre>";
   //    print_r($favPokemonIds);
   //    echo "</pre>";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- CSS -->
      <link rel="stylesheet" href="../CSS/list.css">
      <!-- Google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
      <!-- bibliothèques jQuery et Bootstrap -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <title>Pokémon List</title>
   </head>
   <body>
      <a href="pokemonView.php" class="button-link">Retour</a>
      <h1>Pokémon List</h1>
      <table id="pokemonList">
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Favorite</th>
         </tr>
         <!-- Les données seront insérées ici -->
      </table>
      <script>
         // On crée une variable pour stocker les favoris
         var favPokemonNames = <?php echo $jsonFavPokemonNames; ?>;
         
         // On fetch les pokemons de l'API
         fetch('https://pokeapi.co/api/v2/pokemon?limit=1000')
             .then(response => response.json())
             .then(data => {
                 const pokemonList = document.querySelector('#pokemonList');
                 
                 // Loop sur chaque Pokemon
                 data.results.forEach(pokemon => {
                     const pokemonName = pokemon.name;
                     
                    //  console.log("API: " + pokemonName);
                    //  console.log("Favoris: " + favPokemonNames);
                     
                     // Check si il est dans les favoris
                     const isFavorite = favPokemonNames.includes(pokemonName) ? '*' : '';
                     console.log("Is favorite? " + isFavorite);
                     
                     const row = document.createElement('tr');
                     
                     const idColumn = document.createElement('td');
                     idColumn.textContent = pokemon.url.split('/')[6]; 
                     const nameColumn = document.createElement('td');
                     nameColumn.textContent = pokemonName; 
         
                     const favColumn = document.createElement('td');
                     favColumn.textContent = isFavorite; // * sera dans sa colonne
                     
                     row.appendChild(idColumn);
                     row.appendChild(nameColumn);
                     row.appendChild(favColumn); // 
                     
                     pokemonList.appendChild(row);
                 });
             });
         
      </script>
   </body>
</html>
