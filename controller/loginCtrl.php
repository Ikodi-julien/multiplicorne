<?php
require("model/model.php");

// --- LOGIN FUNCTIONS --- //
function stdLoginView () {
  // Affiche la vue de connexion standard
  require("view/loginViews/stdLoginView.php");
}

function firstLoginView () {
  // Affiche la saisie pour premier login
  require("view/loginViews/firstLoginView.php");
  $_GET['info_login'] = null;
}

function lostPassView () {
  // Affiche la saisie pour récup mot de passe
  require("view/loginViews/lostPassView.php");
  $_GET['info_login'] = null;
}

function visitorView () {
  // Envoi à l'index multiplications si visiteur
  $_SESSION['pseudo'] = 'visiteuse ou visiteur';
  header('Location: index_multiplications.php');
}

function checkLoginCtrl ($pseudo, $pass) {
  
  // On vérifie si le pseudo et le mot de passe existent
  $dataProfil = rqProfil($pseudo);

  if ($dataProfil['mdp'] == $pass) {
      
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['mdp'] = $pass;
    
    // Rediriger vers index_multiplications.php
    require("./view/raceViews/racesIndexView.php");

    } else {
      // Rediriger vers index avec info que le pseudo ou
      // le mdp n'est pas bon.
      $_SESSION['identification'] = 'Erreur de pseudo ou de mot de passe...';
      header('Location: index.php');
  }
}