<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./base.css" />
        <title>Marathon</title>
    </head>
    <body>
        <div id="mainwrapper">
            <?php include("./blocs/header.php"); ?>

            <section id="core">
                    <?php include("./blocs/course_3.html"); ?>

                <div id="milieu_grand">
                    <?php include("./blocs/course_4.html"); ?>
                    <div id="milieu_petit">
                        <?php
                        include("./blocs/commentaires.php");
                        include("./blocs/chrono.html");
                        include("./blocs/multiplication.html");
                        ?>
                    </div>
                    <?php include("./blocs/course_2.html"); ?>
                </div>

                <?php include("./blocs/course_5.html"); ?>

                <div id="info_enregistrement">
                    <?php
                    if (isset($_SESSION['enregistrement']) && $_SESSION['enregistrement'] != null) {
                        echo '<p>'.$_SESSION['enregistrement'].'</p>';
                        $_SESSION['enregistrement'] = null;
                    }
                    ?>
                </div>
            </section>
            <?php include("./blocs/footer.html"); ?>

        </div>
        <script type="module" src="scripts/toutes_tables_melangees.js"></script>
    </body>
</html>
