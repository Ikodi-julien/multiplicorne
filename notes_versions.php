<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="base.css">
    <title>Temps</title>
</head>
<body>
    <section>
    <?php
    include("./blocs/header.php");
    $pseudo = htmlspecialchars($_SESSION['pseudo']);
    ?>
    <h1> Notes de version</h1>
    <?php
    include("./blocs/connexion_bdd.php");

    // Requête les notes de version
    $req = $bdd->execute("SELECT id_version, notes_version, 
    DATE_FORMAT(date_course, ' le %d/%m/%Y à %Hh%i') AS date_version 
    FROM versions
    ORDER BY date_version DESC");

    // Affichage des temps
    while ($donnees = $req->fetch()) {
        echo '<h3>Table : '.$donnees['date_version'].' '.$donnees['note'].'</h3><br />';
    }
    include('./blocs/footer.html'); ?>
    </section>
</body>
</html>