<?php 
$js = '<script src="./scripts/main.js" type="module" defer></script>';
$title = 'Multiplications';

ob_start(); ?>

<section class="content__sprint">

  <div class="content__sprint__comments">
    <?php include("./blocs/commentaires.php"); ?>
  </div>

  <div class="content__sprint__options">
    <?php include("blocs/options.html"); ?>
  </div>
  
  <div class="content__sprint__chrono">
    <?php include("blocs/chrono.html"); ?>
  </div>

  <div class="multiplication">
    <?php include("blocs/multiplication.html"); ?>
  </div>

  <div class="content__sprint__little">
    <?php include("blocs/petite_course.html"); ?>
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
include("blocs/gagnant.php");

$content = ob_get_clean(); 
require('./view/template.php');
 ?>