<?php
session_start(); 
require("controller/raceCtrl.php");

/**
 * Déclaration des variables communes
 */

$pseudo = htmlspecialchars($_SESSION['pseudo']);

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

  } elseif ($time == 'record') {

    $affectedLines = recordTime($pseudo, $table, $mixed, $duration);

    if (!$affectedLines) {
      $_SESSION['enregistrement'] = "Problème d'enregistrement";
      header("Location: ./view/raceViews/".$location.".php");
    } else {
      
    header("Location: racesRouteur.php?time=index");
    }
  } 

} else {
  echo "This is not the droids you're looking for.";
}
