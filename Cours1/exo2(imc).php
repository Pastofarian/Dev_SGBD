<!-- 2) En partant de l’exercice 1, ajoutez un input pour l'âge, le poids et la taille, calculez
ensuite l’IMC de l’utilisateur seulement s’il a au moins 18 ans et moins de 65 ans
IMC = poids (en kg)/taille² (en m) -->

 <?php 

 if (isset($_POST)) {
     if (!empty($_POST["firstname"]) && !empty($_POST["lastname"])) {
         echo "<h1>{$_POST["firstname"]} {$_POST["lastname"]}</h1>";
     }
 }
 if (isset($_POST["age"])){
    $age = $_POST["age"];
    if ($age > 17 && $age < 65){
        $imc = calculImc($_POST["weight"], $_POST["height"]);
        echo "<p>Votre IMC est de {$imc}</p>";
    } else {
        echo "<p>Vous êtes trop vieux ou trop jeune</p>";
    }
}
 
 function calculImc($weight, $height){
    $height = $height / 100;
    return $weight / ($height*$height);
 }
 ?>

 <form action="#" method="POST">
 <label for="lastname">Votre nom :</label>
 <input type="text" name="lastname"><br><br>
 <label for="firstname">Votre prénom :</label>
 <input type="text" name="firstname"><br><br>
 <label for="age">Votre age :</label>
 <input type="number" required="required" name="age"><br><br>
 <label for="height">Votre taille en cm :</label>
 <input type="number" required="required" name="height"><br><br>
 <label for="weight">Votre poid en kg :</label>
 <input type="number" required="required" name="weight"><br><br>

 <input type="submit" value="Envoyer">
 </form>
