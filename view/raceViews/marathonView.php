<?php
$title = "Multiplicorne - Marathon";
$js = '<script src="./public/js/main.js" type="module" defer ></script>';

ob_start();
?>

<section class="content__marathon">
  <?php include("./view/partials/course_3.html"); ?>

  <div class="content__marathon__middle">

      <?php include("./view/partials/course_4.html"); ?>

      <div class="content__marathon__middle__inside">
        
        <div class="content__sprint__comments">
          <?php include("./view/partials/commentaires.php"); ?>
        </div>

        <div class="content__sprint__chrono">
          <?php include("view/partials/chrono.html"); ?>
        </div>

        <div class="multiplication">
          <?php include("view/partials/multiplication.html"); ?>
        </div>

      </div>
      
      <?php include("./view/partials/course_2.html"); ?>

  </div>

  <?php include("./view/partials/course_5.html"); ?>

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
include("view/partials/gagnant.php");

$content = ob_get_clean(); 
require('./view/template.php');

?>