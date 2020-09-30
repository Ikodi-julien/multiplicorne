<?php
session_start(); 
require("./model/model.php");
require("controller/controlleur.php");
require("blocs/commonVar.php");

/**
 *  Routeur for races views
 */

if (isset($_GET['race'])) {
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
  $_SESSION['identification'] = "Il manque une information pour atteindre la page demandée.";
  header('Location: ./index.php?info_login=editProfil');

}