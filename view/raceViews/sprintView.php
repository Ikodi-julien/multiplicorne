<?php 
$css = 'css/base.css';
$js = 'scripts/table_unique.js';
$title = 'Sprint';

ob_start(); ?>

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
            echo '<p>'.htmlspecialchars($_SESSION['enregistrement']).'</p>';
            $_SESSION['enregistrement'] = null;
        }
        ?>
    </div>
</section>

<?php include("./blocs/footer.html");
include("blocs/gagnant.html");

$content = ob_get_clean(); 
require("view/raceViews/templateRace.php"); ?>