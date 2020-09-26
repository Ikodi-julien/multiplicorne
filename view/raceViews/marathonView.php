<?php
$title = "Marathon";
$js = '<script src="./scripts/main.js" type="module" defer ></script>';

ob_start();
?>

<section class="content__marathon">
  <?php include("./blocs/course_3.html"); ?>

  <div class="content__marathon__middle">

      <?php include("./blocs/course_4.html"); ?>

      <div class="content__marathon__middle__inside">
        
        <div class="content__sprint__comments">
          <?php include("./blocs/commentaires.php"); ?>
        </div>

        <div class="content__sprint__chrono">
          <?php include("blocs/chrono.html"); ?>
        </div>

        <div class="content__sprint__multipli">
          <?php include("blocs/multiplication.html"); ?>
        </div>

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
include("blocs/gagnant.html");

$content = ob_get_clean(); 
require('./view/template.php');

?>