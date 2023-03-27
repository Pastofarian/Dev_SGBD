<!-- Réalisez un algorithme capable de détecter la longueur de la chaîne de caractères, de
mots et de phrases dans une chaîne de caractères. Les mots sont séparés par des
espaces et les phrases se terminent par des .
Dans un 2eme temps : Faites en sorte que le total de caractères ne reprenne pas les
points ni les espaces.
analyze_string(“je suis un hibou. Je vis la nuit.”)
=> Ce texte comporte 2 phrases, 8 mots et comporte 33 caractères. 
Dans un 3ème temps
Permettez à l’utilisateur de saisir la chaîne de caractère dans un input HTML et
d’afficher le résultat dans une balise paragraphe.
-->
<?php
function analyze_string ($string) {
    $len = strlen($string); //retourne la longueur d'une chaîne de caractères (nbr de lettre)
    $words = $len ? 1 : 0;
    $sentences = 0;
    for($i=0; $i<$len; $i++) {
        if ($string[$i] == " ") {
            $words++;
        } else if ($string[$i] == ".") {
            $sentences++;
        }
    }

    return "Ce texte comporte {$sentences} phrases, {$words} mots et comporte {$len} caractères";
        
}

$result = analyze_string($_POST["string"]);

?>

 <form action="#" method="POST">
 <label for="string">Votre phrase à analyser :</label>
 <input type="text" name="string"><br><br>
 <input type="submit" value="Envoyer">
 </form>
 <?php echo $result?>