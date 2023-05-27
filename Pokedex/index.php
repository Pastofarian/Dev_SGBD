<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require('autoload.php');

$dao = new PokemonDAO();
$favPokemons = $dao->fetch_all();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pokemon Favorites</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<h1>Favorite Pokemon</h1>
<table border='1'>
<tr><th>ID</th><th>Name</th><th>Sprite</th></tr>

<?php foreach($favPokemons as $pokemon): ?>
<tr>
    <td><?php echo $pokemon->id; ?></td>
    <td><?php echo $pokemon->name; ?></td>
    <td><img src='<?php echo $pokemon->sprite; ?>' alt='<?php echo $pokemon->name; ?>' /></td>
    <td><button class='remove-pokemon' data-id='<?php echo $pokemon->id; ?>'>Remove from Favorites</button></td>
</tr>
<?php endforeach; ?>


</table>
<h1>API Pokemon</h1>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
    echo "<td><button class='add-pokemon' data-id='{$pokemon_id}'>Add to Favorites</button></td>";
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
            success: function(response) { alert(response); location.reload(); },
            error: function(err) { console.log(err); }
        });
    });

    $(".remove-pokemon").click(function(){
        var pokemonId = $(this).data('id'); 
        $.ajax({
            url: 'controllers/pokemonController.php', 
            type: 'post',
            data: {action: 'remove', id: pokemonId},
            success: function(response) { alert(response); location.reload(); },
            error: function(err) { console.log(err); }
        });
    });
});

</script>

</body>
</html>
