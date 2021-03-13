<?php

/**
 * Déclaration des variables communes
 */
$modif = "";
if (isset($_SESSION['pseudo'])) {
  $pseudo = htmlspecialchars($_SESSION['pseudo']);
} else {
  $pseudo = 'visiteur.euse';
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

if (isset($_GET['race_type'])) {
  $raceType = htmlspecialchars($_GET['race_type']);
}

if (isset($_GET['operation_type'])) {
  $operationType = htmlspecialchars($_GET['operation_type']);
}

if (isset($_GET['profil'])) {
  $profil = htmlspecialchars($_GET['profil']);
}

