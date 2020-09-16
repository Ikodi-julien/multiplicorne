<?php
session_start(); 
require("./model/model.php");
require("controller/controlleur.php");
require("blocs/commonVar.php");

/**
 * Index opens with standard login view, 
 * does actions if ask :
 * - Displays other login views (first login, lost password, visitor login),
 * - Displays welcome page and races views,
 * - Check profil pseudo / password,
 * - Displays lost password if asked,
 * - Register new profil,
 * - Register a race time,
 * - Displays all user's times,
 */ 

if (isset($_GET['info_login'])) {
  $infoLogin = htmlspecialchars($_GET['info_login']);
  if ($infoLogin == "premiere") {
    firstLoginView();
  
  } elseif ($infoLogin == "perdu_mdp") {
    lostPassView();
  
  } elseif ($infoLogin == "visiteur") {
    visitorView();

  } elseif ($infoLogin == "disconnect") {
    disconnect();

  } elseif ($infoLogin == "disconnected") {
    echo '<p class="login__info">Vous êtes déconnecté</p>';
    stdLoginView();

  } elseif ($infoLogin == "editProfil") {
    editProfilView();

  } else {
    disconnect();
  }

// Standard login
} elseif (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $pass = htmlspecialchars($_POST['mdp']);

  checkLoginCtrl($pseudo, $pass);

// Cookie login
} elseif (isset($_COOKIE['pseudo']) && isset($_COOKIE['pass_hache'])) {
  $pseudo = htmlspecialchars($_COOKIE['pseudo']);
  $pass_hache = htmlspecialchars($_COOKIE['pass_hache']);

  checkLoginCookie($pseudo, $pass_hache);


// If you ask your password back
} elseif (isset($_POST['mdpPerdu'])) {
    $lostPass = htmlspecialchars($_POST['mdpPerdu']);

    getLostPassword($lostPass);

// If you log in for the first time
} elseif (isset($_POST['newPseudo']) | isset($_POST['newMdp1']) | isset($_POST['newMdp2'])) {
    
  if (isset($_POST['newPseudo']) && isset($_POST['newMdp1']) && isset($_POST['newMdp2'])) {

    $newPass1 = htmlspecialchars($_POST['newMdp1']);
    $newPass2 = htmlspecialchars($_POST['newMdp2']);
    $newPseudo = htmlspecialchars($_POST['newPseudo']);

    registerNewProfil($newPseudo, $newPass1, $newPass2);

  } else {
    $_SESSION['identification'] = "Il faut remplir tous les champs";
    header('Location: ./index.php');

  }
} elseif (isset($_FILES['avatar_fichier'])) {

  if (isset($_FILES['avatar_fichier']) && $_FILES['avatar_fichier']['error'] == 0) {

    // Test si le fichier n'est pas trop gros
    if ($_FILES['avatar_fichier']['size'] < 1000000) {

        // Test de l'extension du fichier, 
        $infosFichier = pathinfo($_FILES['avatar_fichier']['name']);
        $extensionUpload = $infosFichier['extension'];
        $extensionAutorisees = array('jpg', 'jpeg', 'png');

        if (in_array($extensionUpload, $extensionAutorisees)) {

            // Si tout est ok, on redimensionne l'image

            // On charge les images
            if ($extensionUpload == 'jpg' | $extensionUpload == 'jpeg') {
                $source = imagecreatefromjpeg($_FILES['avatar_fichier']['tmp_name']);

            } elseif ($extensionUpload == 'png') {
                $source = imagecreatefrompng($_FILES['avatar_fichier']['tmp_name']);
            }
            
            $destination = imagecreatetruecolor(50, 50);
        
            // Les fonctions imagex et imagey renvoient les largeurs et hauteur d'une image
            $largeur_source = imagesx($source);
            $hauteur_source = imagesy($source);
            $largeur_destination = imagesx($destination);
            $hauteur_destination = imagesy($destination);
        
            // On crée la miniature
            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
        
            // On enregistre l'image de destination 
            imagepng($destination, "avatars/mini_".$pseudo.'.png');
        
            // envoi du fichier initial au stockage final
            move_uploaded_file($_FILES['avatar_fichier']['tmp_name'], 'avatars/'.$pseudo);

            $_SESSION['identification'] = "L'envoi a bien été effectué'";
            header('Location: ./index.php?info_login=editProfil');
              
        } else {
          $_SESSION['identification'] = "Le fichier n'a pas une extension autorisée";
          header('Location: ./index.php?info_login=editProfil');
        }
    } else {
      $_SESSION['identification'] = "Fichier trop gros, max 1Mb";
      header('Location: ./index.php?info_login=editProfil');
      }
  }
  else {
    $_SESSION['identification'] = "Le fichier n'a pas été transmis";
    header('Location: ./index.php?info_login=editProfil');

  }

} else {
  stdLoginView();
}