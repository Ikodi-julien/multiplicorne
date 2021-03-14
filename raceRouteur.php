<?php
session_start(); 
require("./utils/utils.php");
require("./controller/controlleur.php");
require("./view/partials/commonVar.php");
require("./controller/timesControlleur.php");

/**
 *  Routeur for races views
 */

if (isset($_GET['race'])) {
  $race = htmlspecialchars($_GET['race']);

  if (isset($_GET['op'])) {
    
    $operation = htmlspecialchars($_GET['op']);
    
    if ($race == 'sprint') {
    
      if ($operation === 'add') {
        require("view/raceViews/add-subView.php");
      } elseif ($operation == 'sub') {
        require("view/raceViews/add-subView.php");
      } elseif ($operation == 'multipli') {
        require("view/raceViews/multipliView.php");
        
      } else {
        $_SESSION['identification'] = "Il manque une information pour atteindre la page demandée.";
        header('Location: ./raceRouteur.php?race=index');
      }
    
    } elseif ($race == 'marathon') {
      
      if ($operation === 'add_sub') {
      require("view/raceViews/marathonView.php");
      } elseif ($operation == 'multipli') {
      require("view/raceViews/marathonView.php");
      }
    }
    
  } elseif ($race == 'index') {
    require("view/raceViews/racesIndexView.php");

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

    // Ici on récupère les datas liées aux marathons effectués
    $multipliMarathonCount = userRaceCountCtrl($pseudo, 'marathon', 'multipli');
    $bestMultipliMarathon = userBestRaceCtrl($pseudo, 'marathon', 'multipli');
    $multipliMarathonTimes = userLastRaceTimesCtrl($pseudo, 'marathon', 'multipli');
    
    $addSubMarathonCount = userRaceCountCtrl($pseudo, 'marathon', 'add_sub');
    $bestAddSubMarathon = userBestRaceCtrl($pseudo, 'marathon', 'add_sub');
    $addSubMarathonTimes = userLastRaceTimesCtrl($pseudo, 'marathon', 'add_sub');
    
    // Ici on récupère les datas liées aux sprint effectués
    $multipliSprintCount = userRaceCountCtrl($pseudo, 'sprint', 'multipli');
    $allMultipliSprint = userAllSprintMultipli($pseudo);

    $addSprintCount = userRaceCountCtrl($pseudo, 'sprint', 'add');
    $bestAddSprint = userBestRaceCtrl($pseudo, 'sprint', 'add');
    $addSprintTimes = userLastRaceTimesCtrl($pseudo, 'sprint', 'add');

    $subSprintCount = userRaceCountCtrl($pseudo, 'sprint', 'sub');
    $bestSubSprint = userBestRaceCtrl($pseudo, 'sprint', 'sub');
    $subSprintTimes = userLastRaceTimesCtrl($pseudo, 'sprint', 'sub');

    require("./view/timeViews/indexTimeView.php");

  } elseif ($time == 'record') {

    recordTime($pseudo, $raceType, $operationType, $table, $mixed, $duration);

  } 
} else {
  $_SESSION['identification'] = "Il manque une information pour atteindre la page demandée.";
  header('Location: ./raceRouteur.php?race=index');

}