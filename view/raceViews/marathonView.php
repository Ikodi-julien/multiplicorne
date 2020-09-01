<?php
$title = "Marathon";
$css = "./css/base.css";
$js = "./scripts/toutes_tables_melangees.js";

ob_start();
?>

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

<?php include("./blocs/footer.html");
include("blocs/gagnant.html");

$content = ob_get_clean(); 
require("view/raceViews/templateRace.php"); ?>
?>