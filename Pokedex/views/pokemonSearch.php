<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<form id="searchForm">
    <input type="text" id="searchInput" placeholder="Search for a Pokemon">
    <button type="submit">Search</button>
</form>
<script>
         $(document).ready(function(){
            $('#searchForm').on('submit', function(e) {
    e.preventDefault();  // Prevent the form from being submitted normally
    var pokemonName = $('#searchInput').val();  // Get the name entered by the user
    // Make an AJAX call to the show function with the entered name
    $.ajax({
        url: 'pokemons.php?search=1', 
        type: 'post',
        data: {name: pokemonName},
        success: function(response) {
            // Update the banner with the search result
            $('#pokemonImage1').attr('src', response.sprite);
            $('#pokemonName1').text(response.name);
            $('#addToFavorites1').data('id', response.id);
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
