<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="base.css" />
        <title>Sprint</title>
    </head>
    <body>
        <div id="mainwrapper">

            <?php include("./blocs/header.php"); ?>
            <section id="core">
                <div id="commentaires_options">
                <?php
                include("./blocs/commentaires.php");
                include("blocs/options.html");
                ?>
                </div>
                
                <?php
                include("blocs/chrono.html");
                include("blocs/multiplication.html");
                include("blocs/petite_course.html");
                ?>

                <div id="info_enregistrement">
                    <?php
                    if (isset($_SESSION['enregistrement']) && $_SESSION['enregistrement'] != null) {
                        echo '<p>'.$_SESSION['enregistrement'].'</p>';
                        $_SESSION['enregistrement'] = null;
                    }
                    ?>
                </div>
            </section>

            <?php include("./blocs/footer.html");
            include("blocs/gagnant.html"); ?>

        </div>
        <script type="module" src="scripts/table_unique.js" ></script>

    </body>
</html>
