<!-- 4) Réalisez une fonction capable de lister les N premiers nombres premiers
premiers(5)
=> 2, 3, 5, 7, 11 -->

<?php

function listPrimeNumbers($n) {
    $prime_numbers = array(); // initialisation d'un tableau vide pour stocker les nombres premiers trouvés
    $number = 2; // on commence par tester à partir de 2, le premier nombre premier

    while (count($prime_numbers) < $n) { // tant qu'on n'a pas trouvé le nombre de nombres premiers demandé
        $is_prime = true; // on part du principe que le nombre testé est premier

        for ($i = 2; $i <= sqrt($number); $i++) { // on teste les diviseurs de 2 à la racine carrée du nombre testé
            if ($number % $i == 0) { // si le nombre testé est divisible par un autre nombre que 1 et lui-même
                $is_prime = false; // alors il n'est pas premier
                break; // on sort de la boucle
            }
        }

        if ($is_prime) { // si le nombre testé est premier
            $prime_numbers[] = $number; // on l'ajoute au tableau des nombres premiers trouvés
        }

        $number++; // on passe au nombre suivant
    }

    return $prime_numbers; // on retourne le tableau des nombres premiers trouvés
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des N premiers nombres premiers</title>
</head>
<body>
    <h1>Liste des N premiers nombres premiers</h1>

    <form method="post">
        <label for="number">Entrez un nombre :</label>
        <input type="number" name="number" id="number">
        <input type="submit" value="Afficher la liste">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // si le formulaire a été soumis
        $n = $_POST["number"]; // on récupère le nombre saisi dans le champ de formulaire
        $prime_numbers = listPrimeNumbers($n); // on appelle la fonction listerNombresPremiers() avec le nombre saisi en argument

        echo "<h2>Les ".$n." premiers nombres premiers sont :</h2>";
        echo "<ul>";
        foreach ($prime_numbers as $prime_number) { // on boucle sur le tableau des nombres premiers trouvés pour les afficher
            echo "<li>".$prime_number."</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
