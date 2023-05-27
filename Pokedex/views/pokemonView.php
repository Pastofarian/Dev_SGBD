<?php
require('../autoload.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$dao = new PokemonDAO();
$favPokemons = $dao->fetch_all();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pokemons</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pokemon ajouté</h4>
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
<div class="modal fade" id="removeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pokemon retiré de la base de données</h4>
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
<h1>Pokemons favoris</h1>
<table border='1'>
<tr><th>ID</th><th>Nom</th><th>Sprite</th><th>Types</th><th>Compétences</th><th>Action</th></tr>

<?php foreach($favPokemons as $pokemon): ?>
<tr>
    <td><?php echo $pokemon->id; ?></td>
    <td><?php echo $pokemon->name; ?></td>
    <td><img src='<?php echo $pokemon->sprite; ?>' alt='<?php echo $pokemon->name; ?>' /></td>
    <td>
        <?php 
        foreach($pokemon->type as $type) {
            echo $type . " ";
        }
        ?>
    </td>
    <td>
        <button class="btn btn-primary action-button" type="button" data-toggle="collapse" data-target="#moves<?php echo $pokemon->id; ?>" aria-expanded="false" aria-controls="moves<?php echo $pokemon->id; ?>">
          Show/Hide Moves
        </button>
        
        <div class="collapse" id="moves<?php echo $pokemon->id; ?>">
          <div class="card card-body">
            <?php 
            foreach($pokemon->moves as $move) {
                echo $move . " ";
            }
            ?>
          </div>
        </div>
    </td>
    <td><button class='remove-pokemon action-button' data-id='<?php echo $pokemon->id; ?>'>Retirer des favoris</button></td>
</tr>
<?php endforeach; ?>




</table>
<h1>Pokemons disponible(api)</h1>
<?php
$api_url = 'https://pokeapi.co/api/v2/pokemon';
$response = file_get_contents($api_url);
$data = json_decode($response, true);

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

    $apiPokemon = new Pokemon(
        $pokemon_data['id'],
        $pokemon_data['name'],
        $pokemon_data['sprites']['front_default'],
        $pokemon_moves,
        $pokemon_types
    );

    $apiPokemons[] = $apiPokemon;
}

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
          Show/Hide Moves
        </button>";
    echo "<div class='collapse' id='apiMoves{$pokemon->id}'>
          <div class='card card-body'>";
    foreach($pokemon->moves as $move) {
        echo $move . " ";
    }
    echo "</div></div></td>";
    echo "<td><button class='add-pokemon action-button' data-id='{$pokemon->id}'>Add to favorites</button></td>";
    echo "</tr>";
endforeach;

echo "</table>";
?>

<script>
$(document).ready(function(){
    $(".add-pokemon").click(function(){
    var pokemonId = $(this).data('id'); 
    $.ajax({
        url: '../controllers/pokemonController.php', 
        type: 'post',
        data: {action: 'add', id: pokemonId},
        success: function(response) {
            $('#pokemonName').text(response); 
            $('#myModal').modal('show'); 
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) { 
            alert('Error: ' + jqXHR.responseText);
        }
    });
});
$(".remove-pokemon").click(function(){
    var pokemonId = $(this).data('id'); 
    $.ajax({
        url: '../controllers/pokemonController.php', 
        type: 'post',
        data: {action: 'remove', id: pokemonId},
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
</script>

</body>
</html>
