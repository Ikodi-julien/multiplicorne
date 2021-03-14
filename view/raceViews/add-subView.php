<?php 
$js = '<script src="./public/js/main.js" type="module" defer></script>';
$title = 'Addition - Soustraction';

ob_start(); ?>

<section class="content__sprint">

  <div class="content__sprint__comments">
    <?php include("./view/partials/commentaires.php"); ?>
  </div>


  <div class="content__sprint__chrono">
    <?php include("view/partials/chrono.html"); ?>
  </div>

  <div class="multiplication">
    <?php include("view/partials/multiplication.html"); ?>
  </div>

  <div class="content__sprint__little">
    <?php include("view/partials/petite_course.html"); ?>
  </div>

  <div class="content__sprint__intel">
      <?php
      if (isset($_SESSION['enregistrement']) && $_SESSION['enregistrement'] != null) {
        $intel = htmlspecialchars($_SESSION['enregistrement']);
          echo '<p>'.$intel.'</p>';
          $_SESSION['enregistrement'] = null;
      }
      ?>
  </div>

</section>

<?php
include("./view/partials/gagnant.php");

$content = ob_get_clean(); 
require('./view/template.php');
 ?>