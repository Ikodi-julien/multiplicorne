<?php

/**
 * Controlleur 
 *  
 */

/**
 * Displays standard login view
 */
function stdLoginView () {
  require("view/loginViews/stdLoginView.php");
}

/**
 * Displays first login view
 */
function firstLoginView () {
  // Affiche la saisie pour premier login
  require("view/loginViews/firstLoginView.php");
  $_GET['info_login'] = null;
}

/**
 * Displays a form to get user's password back
 */
function lostPassView () {
  // Affiche la saisie pour récup mot de passe
  require("view/loginViews/lostPassView.php");
  $_GET['info_login'] = null;
}

/**
 * Displays visitor view
 */
function visitorView () {

  $_SESSION['pseudo'] = 'visiteuse ou visiteur';
  require("view/raceViews/racesIndexView.php");
}

/**
 * Displays profil view
 */
function editProfilView () {

  require("view/profilView/profilView.php");
}


/**
 * Check if user's pseudo and pass are known, if not
 * send back to identification with intel.
 */
function checkLoginCtrl ($pseudo, $pass) {
  
  // On vérifie si le pseudo et le mot de passe existent
  $dataProfil = rqProfil($pseudo);

  if (!$dataProfil) {
    $_POST['pseudo'] = null;
    $_POST['mdp'] = null;
    $_SESSION['identification'] = 'Erreur de pseudo ou de mot de passe...';
    header('Location: index.php');

  } else {
    // Comparaison pass envoyé et celui dans la base.
    $is_pass_correct = password_verify($pass, $dataProfil['mdp']);

    // Comparaison mdp saisi et celui en bdd
    if ($is_pass_correct) {
        $_SESSION['pseudo'] = $pseudo;

        // On met les cookies si connexion auto coché
        if (isset($_POST['auto'])) {
        $pass_hache = password_hash($pass, PASSWORD_DEFAULT);
        setcookie('pseudo', $pseudo, time() + 3600*24*365, null, null, false, true);
        setcookie('pass_hache', $pass_hache, time() + 3600*24*365, null, null, false, true);
        }
        
        // Redirection vers raceView.php
        require("./view/raceViews/racesIndexView.php");
        
    } else {
      $_SESSION['identification'] = 'Erreur de pseudo ou de mot de passe...';
      header('Location: index.php');
    }
  }
}

function checkLoginCookie ($pseudo, $pass_hache) {
  
  // On vérifie si le pseudo et le mot de passe existent
  $dataProfil = rqProfil($pseudo);

  if (!$dataProfil) {
    $_SESSION['identification'] = 'Problème d\'identification';
    require("./view/loginViews/stdLoginView.php");

  } else {
    $_SESSION['pseudo'] = $pseudo;
    require("./view/raceViews/racesIndexView.php");

  }
}

/**
 * Get a password from pseudo and 
 * displays lost password in index page.
 */

function getLostPassword($lostPass) {

  $data = rqPass($lostPass);

  if (isset($data['mdp'])) {
    $_SESSION['identification'] = 'Ton mot de passe : '.$data['mdp'];
    $_POST['mdpPerdu'] = null;
    header('Location: index.php');

  } else {
    $_SESSION['identification'] = 'Pas de mot de passe correspondant au pseudo : '.$lostPass;
    $_POST['mdpPerdu'] = null;
    header('Location: index.php');

  }
}

/**
 * Register a new user's Pseudo and Password
 */

function registerNewProfil($newPseudo, $newPass1, $newPass2) {

  // Check passwords are the same
  if ($newPass1 != $newPass2) {
    $_POST['newMdp1'] = null;
    $_POST['newMdp2'] = null;
    $_SESSION['identification'] = 'Les mots de passe ne sont pas identiques';
    header('Location: index.php');

  } else {
    // Check if pseudo already exist
    $dataProfil = rqProfil($newPseudo);
    
    if (empty($dataProfil['mdp'])) {

      $pass_hache = password_hash($newPass1,PASSWORD_DEFAULT);

      $affectedLines = insertNewProfil($newPseudo, $pass_hache);

      if ($affectedLines) {
        $_SESSION['identification'] = 'Profil enregistré, tu peux te connecter';
        header('Location: ./index.php');
        
      } else {
        $_SESSION['identification'] = 'Problème d\'enregistrement, désolé !';
        header('Location: ./index.php');
      
      }
    } else {
      $_SESSION['identification'] = "Désolé ce pseudo est déjà prit";
      header('Location: ./index.php');

    }
  }
}

/**
 * get all user' times
 */

function displayUserTimes($pseudo) {

  $rqTimes = rqTimes($pseudo);

  return $rqTimes;
}

/**
 * Register a race time
 */

function recordTime($pseudo, $table, $mixed, $duration) {
  $affectedLines = insertTime($pseudo, $table, $mixed, $duration);

  if (!$affectedLines) {
    $_SESSION['enregistrement'] = "Problème d'enregistrement";
    header("Location: ./view/raceViews/".$location.".php");

  } else {
    header("Location: raceRouteur.php?time=index");
  }
}

// function setAvatar($_FILES['']) {

//     {
