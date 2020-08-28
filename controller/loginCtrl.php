<?php

// --- LOGIN FUNCTIONS --- //
function stdLogin () {
  // Affiche la vue de connexion standard
  require("view/stdLoginView.php");
}

function firstLogin () {
  // Affiche la saisie pour premier login
  require("view/firstLoginView.php");
  $_GET['info_login'] = null;
}

function lostPass () {
  // Affiche la saisie pour récup mot de passe
  require("view/lostPassView.php");
  $_GET['info_login'] = null;
}

function visitor () {
  // Envoi à l'index multiplications si visiteur
  $_SESSION['pseudo'] = 'visiteuse ou visiteur';
  header('Location: index_multiplications.php');
}
