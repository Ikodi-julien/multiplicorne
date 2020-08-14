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
    <section id=stats>
    <?php
    include("./blocs/header.php");
    $pseudo = htmlspecialchars($_SESSION['pseudo']);
    ?>
    <h1> Temps toutes tables mélangées de <?php echo $pseudo; ?></h1>
    <?php
    include("./blocs/connexion_bdd.php");

    // Requête 5 meilleurs temps groupés par table
    $req = $bdd->prepare("SELECT temps_course, table_multiplication, melange, 
    DATE_FORMAT(date_course, ' le %d/%m/%Y à %Hh%i') AS date_course 
    FROM course_multiplication 
    WHERE id_coureur= :id_coureur 
    ORDER BY date_course DESC");
    $req->execute(array(
        'id_coureur' => $pseudo,
    ));

    // Affichage des temps
    while ($donnees = $req->fetch()) {
        echo '<h3>Table : '.$donnees['table_multiplication'].' '.$donnees['melange'].' en '.$donnees['temps_course'].$donnees['date_course'].'</h3><br />';
    }
    include('./blocs/footer.html'); ?>
    </section>
</body>
</html>