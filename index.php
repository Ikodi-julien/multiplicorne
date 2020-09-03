<?php
session_start(); 
require("./model/model.php");
require("controller/controlleur.php");


/**
 * Déclaration des variables communes
 */
if (isset($_SESSION['pseudo'])) {
  $pseudo = htmlspecialchars($_SESSION['pseudo']);
}

if (isset($_GET['table'])) {
  $table = htmlspecialchars($_GET['table']);
}
if (isset($_GET['location'])) {
  $location = htmlspecialchars($_GET['location']);
}

if (isset($_GET['mixed'])) {
  $mixed = htmlspecialchars($_GET['mixed']);
}

if (isset($_GET['duration'])) {
  $duration = htmlspecialchars($_GET['duration']);
}

if (isset($_SESSION['identification'])) {
  $identification = htmlspecialchars($_SESSION['identification']);
  echo '<p id="info_identification">'.$_SESSION['identification'].'</p>';
  $_SESSION['identification'] = null;
}

/**
 * Index opens with standard login view, 
 * does actions if ask :
 * - Displays other login views (first login, lost password, visitor login),
 * - Displays welcome page and races views,
 * - Check profil pseudo / password,
 * - Displays lost password if asked,
 * - Register new profil,
 * - Register a race time,
 * - Displays all user's times,
 */ 

if (isset($_GET['info_login'])) {
  $infoLogin = htmlspecialchars($_GET['info_login']);
  if ($infoLogin == "premiere") {
    firstLoginView();
  
  } elseif ($infoLogin == "perdu_mdp") {
    lostPassView();
  
  } elseif ($infoLogin == "visiteur") {
    visitorView();

  }

// Standard login
} elseif (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $pass = htmlspecialchars($_POST['mdp']);

  checkLoginCtrl($pseudo, $pass);


// If you ask your password back
} elseif (isset($_POST['mdpPerdu'])) {
    $lostPass = htmlspecialchars($_POST['mdpPerdu']);

    getLostPassword($lostPass);

// If you log in for the first time
} elseif (isset($_POST['newPseudo']) && isset($_POST['newMdp'])) {
    $newPass = htmlspecialchars($_POST['newMdp']);
    $newPseudo = htmlspecialchars($_POST['newPseudo']);

    registerNewProfil($newPseudo, $newPass);

/**
 *  Routeur for races views
 */

} elseif (isset($_GET['race'])) {
  $race = htmlspecialchars($_GET['race']);

  if ($race == 'index') {
    require("view/raceViews/racesIndexView.php");

  } elseif ($race == 'sprint') {
    require("view/raceViews/sprintView.php");

  } elseif ($race == 'marathon') {
    require("view/raceViews/marathonView.php");
  }
/**
 * Routeur vers les actions possible liées aux temps :
 * 
 * Afficher les temps;
 * 
 * Enregistrer le temps;
 * 
 * Comparer le dernier temps aux précédents -> A faire
 */

} elseif (isset($_GET['time'])) {
  $time = htmlspecialchars($_GET['time']);

  if ($time == 'index') {
    $rqTimes = displayUserTimes($pseudo);

    require("./view/timeViews/indexTimeView.php");

  } elseif ($time == 'record') {

    recordTime($pseudo, $table, $mixed, $duration);

  } 
} else {
  stdLoginView();

}