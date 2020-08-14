<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="base.css" />
        <script src="choix_tables.js" defer></script>
        <title>ACCUEIL</title>
    </head>
    <body>
        <section class="accueil">
        <?php include("./blocs/header.php"); ?>

            <div class="presentation">
                <h1 id='titre_index'>Bonjour <?php echo htmlspecialchars($_SESSION['pseudo']);
                ?>, prêt(e) pour faire la course ?</h1>
                <h3>Quelques informations pour commencer :</h3>
                <ul>
                    <li>En choisissant "Sprint" la course dure le temps d'une table de multiplication, tu peux choisir de la mélanger ou non.</li>
                    <li>Avec "Marathon" ce sont toutes les tables du 2 au 9, dans le désordre, qu'il faudra résoudre pour arriver à la fin.</li>
                    <li>Si tu as choisi un pseudo et un mot de passe, tu peux enregistrer tes temps et voir tes progrès !</li>
                </ul>
            </div>
        </section>

    </body>
</html>
