<!-- Récupération des données -->
<?php
session_start(); 
require("controller/loginCtrl.php");

if (isset($_GET['info_login'])) {
  $infoLogin = htmlspecialchars($_GET['info_login']);
  if ($infoLogin == "premiere") {
    firstLogin();
  
  } elseif ($infoLogin == "perdu_mdp") {
    lostPass();
  
  } elseif ($infoLogin == "visiteur") {
    visitor();

  }
} else {
    stdLogin();

}    

if (isset($_SESSION['identification'])) {
    $identification = htmlspecialchars($_SESSION['identification']);
    echo '<p id="info_identification">'.$_SESSION['identification'].'</p>';
    $_SESSION['identification'] = null;
}
