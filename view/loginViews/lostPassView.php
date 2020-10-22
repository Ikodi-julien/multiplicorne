<?php $title = "Multiplicorne - Récupère ton mot de passe";
ob_start(); ?>

<h3>Entre ton pseudo pour récupérer ton mot de passe</h3>
<form action="./index.php?info_login=sendPass" method="post">
    <p>Pseudonyme : </p>
    <input type="text" name="pseudo"><br />
    <p>Email : </p>
    <input type="email" name="email"><br />
    <button type="submit" >Valider</button>
    <a href="index.php">Retour à l'accueil</a>
</form></br>

<?php $content = ob_get_clean();
require("./view/loginViews/templateLogin.php"); ?>