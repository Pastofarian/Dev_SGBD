<?php
require('autoload.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$dao = new PokemonDAO();
$favPokemons = $dao->fetch_all();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pokemon Favorites</title>
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
<tr><th>ID</th><th>Nom</th><th>Sprite</th><th>Action</th></tr>

<?php foreach($favPokemons as $pokemon): ?>
<tr>
    <td><?php echo $pokemon->id; ?></td>
    <td><?php echo $pokemon->name; ?></td>
    <td><img src='<?php echo $pokemon->sprite; ?>' alt='<?php echo $pokemon->name; ?>' /></td>
    <td><button class='remove-pokemon' data-id='<?php echo $pokemon->id; ?>'>Retirer des favoris</button></td>
</tr>
<?php endforeach; ?>


</table>
<h1>Pokemons disponible(API)</h1>
<?php
$api_url = 'https://pokeapi.co/api/v2/pokemon';
$response = file_get_contents($api_url);
$data = json_decode($response, true);

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Sprite</th><th>Action</th></tr>";

foreach ($data['results'] as $key => $pokemon) {
    $pokemon_url = $pokemon['url'];
    $pokemon_data = json_decode(file_get_contents($pokemon_url), true);
    $pokemon_name = $pokemon_data['name'];
    $pokemon_id = $pokemon_data['id'];
    $pokemon_sprite = $pokemon_data['sprites']['front_default'];

    echo "<tr>";
    echo "<td>{$pokemon_id}</td>";
    echo "<td>{$pokemon_name}</td>";
    echo "<td><img src='{$pokemon_sprite}' alt='{$pokemon_name}' /></td>";
    echo "<td><button class='add-pokemon' data-id='{$pokemon_id}'>Ajouté à vos favoris</button></td>";
    echo "</tr>";
}

echo "</table>";
?>

<script>
$(document).ready(function(){
    $(".add-pokemon").click(function(){
    var pokemonId = $(this).data('id'); 
    $.ajax({
        url: 'controllers/pokemonController.php', 
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
        url: 'controllers/pokemonController.php', 
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
