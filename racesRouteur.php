<?php
session_start(); 
require("controller/raceCtrl.php");

$pseudo = htmlspecialchars($_SESSION['pseudo']);

/**
 *  Routeur vers les vues
 */

if (isset($_GET['race'])) {
  $race = htmlspecialchars($_GET['race']);

  if ($race == 'index') {
  require("view/raceViews/racesIndexView.php");

  } elseif ($race == 'sprint') {
    require("view/raceViews/sprintView.php");

  } elseif ($race == 'marathon') {
    require("view/raceViews/marathonView.php");

  } else {
  echo "This is not the droids you're looking for.";
  }

  /**
 * Routeur vers les actions possible liées aux temps :
 * 
 * Afficher les temps;
 * 
 * Enregistrer le temps;
 * 
 * Comparer le dernier temps aux précédents;
 */

} elseif (isset($_GET['time'])) {
  $time = htmlspecialchars($_GET['time']);

  if ($time == 'index') {
    $rqTimes = displayUserTimes($pseudo);

    require("./view/timeViews/indexTimeView.php");

  } 

} else {
  echo "This is not the droids you're looking for.";
}
