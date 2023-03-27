
<!--  1) Réalisez un formulaire avec 2 inputs de type text, nom et prénom, lors de l’envoi du
 formulaire affichez le prénom et le nom dans une balise h1 -->
 <?php 
if (isset($_POST)) {
    if (!empty($_POST["firstname"]) && !empty($_POST["lastname"])) {
        echo "<h1>{$_POST["firstname"]} {$_POST["lastname"]}</h1>";
    }
}
?>
<form action="#" method="POST">
<label for="lastname">Votre nom :</label>
<input type="text" required="required" name="lastname"><br><br>
<label for="firstname">Votre prénom :</label>
<input type="text" required="required" name="firstname"><br><br>
<input type="submit" value="Envoyer">
</form>