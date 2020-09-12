<?php 
$css = './css/style.css';
$js = '<script src="./scripts/table_unique.js" type="module" defer></script>';
$title = 'Sprint';

ob_start(); ?>

<section class="race__sprint">

  <div class="race__sprint__comments">
    <?php include("./blocs/commentaires.php"); ?>
  </div>

  <div class="race__sprint__options">
    <?php include("blocs/options.html"); ?>
  </div>
  
  <div class="race__sprint__chrono">
    <?php include("blocs/chrono.html"); ?>
  </div>

  <div class="race__sprint__multipli">
    <?php include("blocs/multiplication.html"); ?>
  </div>

  <div class="race__sprint__little">
    <?php include("blocs/petite_course.html"); ?>
  </div>

  <div class="race__sprint__intel">
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

$content = ob_get_clean(); 
require("view/raceViews/templateRace.php"); ?>