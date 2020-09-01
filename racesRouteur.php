<?php
session_start(); 
require("controller/raceCtrl.php");

/**
 *  Routeur vers les vues
 */

if (isset($_GET['race'])) {
  $race = htmlspecialchars($_GET['race']);

  if ($race == 'index') {
  require("view/raceViews/racesIndexView.php");

  } elseif ($race == 'sprint') {
    require("view/raceViews/sprintView.php");

    }
} else {
  echo "Mettre un message d'erreur quand y'a pas de course précisée";
}


/**
 * Routeur vers les actions possible
 * 
 * enregistrer temps
 * 
 * récupérer les temps d'un utilisateur
 * 
 * d'autres à venir ?
 */

if (isset($_GET['time'])) {
  $time = htmlspecialchars($_GET['time']);
}
