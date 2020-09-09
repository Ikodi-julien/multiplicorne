<?php
$title = "Marathon";
$css = "./css/style.css";
$js = '<script src="./scripts/toutes_tables_melangees.js"></script>';

ob_start();
?>

<section class="race__marathon">
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

<?php 
$content = ob_get_clean(); 
require("view/raceViews/templateRace.php"); ?>