<?php $title = "Récupère ton mot de passe";
ob_start(); ?>

<h3>Entre ton pseudo pour récupérer ton mot de passe</h3>
<form action="./index.php" method="post">
    <p>Pseudonyme : </p>
    <input type="text" name="mdpPerdu" id="mdpPerdu"><br />
    <button type="submit" >Valider</button>
    <a href="index.php">Retour à l'accueil</a>
</form></br>

<?php $content = ob_get_clean();
require("./view/loginViews/templateLogin.php"); ?>