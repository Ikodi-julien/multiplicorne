<?php

/**
 * Déclaration des variables communes
 */
$modif = "";
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

if (isset($_GET['profil'])) {
  $profil = htmlspecialchars($_GET['profil']);
}

if (isset($_SESSION['identification'])) {
  $identification = htmlspecialchars($_SESSION['identification']);
  echo '<p class="login__info">'.$_SESSION['identification'].'</p>';
  
  $_SESSION['identification'] = null;
  
} 
