<?php
require('./model/model.php');

/**
 * --- LOGIN FORMS ---
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

  $_SESSION['pseudo'] = 'visiteur.euse';
  $_SESSION['avatar'] = 'licorne';
  require("view/raceViews/racesIndexView.php");
}

/**
 * --- LOGIN CONTROL ---
 */
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
        $_SESSION['style'] = $dataProfil['style'];
        $_SESSION['avatar'] = $dataProfil['avatar'];

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
    
    $_SESSION['identification'] = 'Problème d\'identifiant';
    require("./view/loginViews/stdLoginView.php");

  } else {

    // // Comparaison mdp saisi et celui en bdd
    // if ($pass_hache != $dataProfil['mdp']) {
    //   $_SESSION['identification'] = 'Problème d\'identification';
    //   require("./view/loginViews/stdLoginView.php");

    // } else {
  
      $_SESSION['pseudo'] = $pseudo;
      $_SESSION['style'] = $dataProfil['style'];
      $_SESSION['avatar'] = $dataProfil['avatar'];
      require("./view/raceViews/racesIndexView.php");

    // }
  }
}

/**
 * Send back a password by email if requested
 */

function checkAndSendPass () {

  if (isset($_POST['pseudo']) && isset($_POST['email'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mailTo = htmlspecialchars($_POST['email']);
    $dataProfil = rqProfil($pseudo);

    if ($dataProfil['email'] != $mailTo) {
      $_POST['pseudo'] = null;
      $_POST['email'] = null;
      $_SESSION['identification'] = 'L\'email ne correspond pas à celui renseigné lors de l\'inscription';
      header('Location: index.php?info_login=perdu_mdp');
  
    } else {
      $subject = "Mot de passe Multiplicorne";
      $message = 'Votre nouveau mot de passe est : "multiplicorne", vous pouvez le changer depuis votre espace membre :-)';
      $isSend = sendMail($mailTo, $pseudo, $subject, $message);
      $_POST['pseudo'] = null;
      $_POST['email'] = null;

      if ($isSend) {
        $passHache = password_hash("multiplicorne", PASSWORD_DEFAULT);
        $affectedLines = insertNewPass($passHache, $pseudo);

        if ($affectedLines) {
          $_SESSION['identification'] = 'L\'email avec votre nouveau mot de passe a été envoyé';
          header('Location: index.php');
  
        } else {
          $_SESSION['identification'] = 'L\'email a été envoyé mais il y a un problème avec la base de données...';
          header('Location: index.php');  
        }
  
      } else {
        $_SESSION['identification'] = 'L\'email n\'a pas été envoyé';
        header('Location: index.php');
  
      }
    }
  } else {
    $_POST['pseudo'] = null;
    $_POST['email'] = null;
    $_SESSION['identification'] = 'Les informations sont incomplètes';
    header('Location: index.php?info_login=perdu_mdp');

  }
}

/**
 * Send an email from contact page
 */

function sendMailContact() {

  if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {

    $name = htmlspecialchars($_POST['name']);
    $mailTo = "jupellin39@gmail.com";
    $userMail = htmlspecialchars($_POST['email']);
    $rowMessage = htmlspecialchars($_POST['message']);
    $message = "De : ".$userMail."\n".$rowMessage;
    $subject = "Multiplicorne - Message depuis le formulaire de contact";

    $isSend = sendMail($mailTo, $name, $subject, $message);

    if ($isSend) {
      $_SESSION['identification'] = 'Merci ! Le message a bien été envoyé.';
      header('Location: index.php?info_login=contact');
  
    }

  } else {
    $_SESSION['identification'] = "Désolé, il faut remplir le nom, l'email et le message :-)";
    header('Location: index.php?info_login=contact');

  }
}

/**
 * Register a new user's Pseudo and Password
 */

function registerNewProfil($newPseudo, $newPass1, $newPass2, $email_1, $email_2) {

  // Check passwords are the same
  if ($newPass1 != $newPass2) {
    $_POST['newMdp1'] = null;
    $_POST['newMdp2'] = null;
    $_SESSION['identification'] = 'Les mots de passe ne sont pas identiques';
    header('Location: index.php?info_login=premiere');

  } elseif ($email_1 != $email_2) {
    $_POST['email_1'] = null;
    $_POST['email_2'] = null;
    $_SESSION['identification'] = 'Les mots de passe ne sont pas identiques';
    header('Location: index.php?info_login=premiere');
  } else {

    // Check if pseudo already exist
    $dataProfil = rqProfil($newPseudo);
    
    if (empty($dataProfil['mdp'])) {

      $pass_hache = password_hash($newPass1,PASSWORD_DEFAULT);

      $affectedLines = insertNewProfil($newPseudo, $pass_hache, $email_1);

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
 * --- RACE TIMES ---
 */

/**
 * Register a race time
 */

function recordTime($pseudo, $raceType, $operationType, $table, $mixed, $duration) {
  $affectedLines = insertTime($pseudo, $raceType, $operationType, $table, $mixed, $duration);

  if (!$affectedLines) {
    $_SESSION['enregistrement'] = "Problème d'enregistrement";
    header("Location: raceRouteur.php?race=" + $raceType + "&op=" + $operationType);

  } else {
    header("Location: raceRouteur.php?time=index");
  }
}

/**
 * --- PROFIL ---
 */

function setProfilPhoto($pseudo) {

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
            $moveUploadedFile = move_uploaded_file($_FILES['avatar_fichier']['tmp_name'], 'avatars/'.$pseudo);

            if ($moveUploadedFile) {
              $_SESSION['identification'] = "L'envoi a bien été effectué'";
              header('Location: ./profilRouteur.php?profil=profil');
  
            } else {
              $_SESSION['identification'] = "L'envoi n'a pas été fait";
              header('Location: ./profilRouteur.php?profil=profil');
  
            }

              
        } else {
          $_SESSION['identification'] = "Le fichier n'a pas une extension autorisée";
          header('Location: ./profilRouteur.php?profil=profil');
        }
    } else {
      $_SESSION['identification'] = "Fichier trop gros, max 1Mb";
      header('Location: ./profilRouteur.php?profil=profil');
      }
  }
  else {
    $_SESSION['identification'] = "Le fichier n'a pas été transmis";
    header('Location: ./profilRouteur.php?profil=profil');

  }
}

/**
 * Displays profil view
 */
function profilView ($pseudo, $modif) {
  $profilInfo = getProfilInfo($pseudo);

  if ($profilInfo) {
    require("view/profilView/profilView.php");

  } else {
  stdLoginView();

  }
}

/**
 * Change avatar
 */
function setAvatar($pseudo) {
  if (isset($_POST['avatar'])) {
    $newAvatar = htmlspecialchars($_POST['avatar']);
    $affectedLines = insertNewAvatar($pseudo, $newAvatar);

    if ($affectedLines) {
      $_SESSION['avatar'] = $newAvatar;
      header('Location: ./profilRouteur.php?profil=profil');
  
    } else {
      $_SESSION['identification'] = "L'avatar n'a pu être changée";
      header('Location: ./profilRouteur.php?profil=profil');
    
    }
  } else {
    $_SESSION['identification'] = "Pas d'avatar choisi";
    header('Location: ./profilRouteur.php?profil=profil');

  }
}


/**
 * Change email in database
 */
function changeEmail($pseudo) {
  if (isset($_POST['new-email'])) {
    $newEmail = htmlspecialchars($_POST['new-email']);
    $affectedLines = insertNewEmail($pseudo, $newEmail);

    if ($affectedLines) {
      header('Location: ./profilRouteur.php?profil=profil');
  
    } else {
      $_SESSION['identification'] = "L'email n'a pu être changé";
      header('Location: ./profilRouteur.php?profil=profil');
    
    }
  } else {
    $_SESSION['identification'] = "Il faut renseigner une adresse mail";
    header('Location: ./profilRouteur.php?profil=profil');

  }
}

/**
 * Change user's birth date in database
 */
function changeBirthDate($pseudo) {
  if (isset($_POST['newBirthDate'])) {
    $newBirthDate = htmlspecialchars($_POST['newBirthDate']);
    $affectedLines = insertNewBirthDate($pseudo, $newBirthDate);

    if ($affectedLines) {
      header('Location: ./profilRouteur.php?profil=profil');
  
    } else {
      $_SESSION['identification'] = "La date de naissance n'a pu être changé";
      header('Location: ./profilRouteur.php?profil=profil');
    
    }
  } else {
    $_SESSION['identification'] = "Il faut renseigner une date de naissance";
    header('Location: ./profilRouteur.php?profil=profil');

  }
}

/**
 * Change user's password in database
 */
function changePass($pseudo) {
  if (isset($_POST['newPass1']) && isset($_POST['newPass2']) && isset($_POST['pass'])) {
    $newPass1 = htmlspecialchars($_POST['newPass1']);
    $newPass2 = htmlspecialchars($_POST['newPass2']);
    $pass = htmlspecialchars($_POST['pass']);

    // Vérifier si mot de passe ok avec le pseudo
    $dataProfil = rqProfil($pseudo);
    $isPassCorrect = password_verify($pass, $dataProfil['mdp']);

    if ($isPassCorrect) {
      // Vérifier que les deux nouveaux mots de passe sont remplis et identiques
      if (($newPass1 != $newPass2) | empty($newPass1)) {
        $_SESSION['identification'] = "Les nouveaux mots de passe sont vides ou différents";
        header('Location: ./profilRouteur.php?profil=profil');

      } else {
        $passHache = password_hash($newPass1, PASSWORD_DEFAULT);
        $affectedLines = insertNewPass($passHache, $pseudo);
  
        if ($affectedLines) {
          header('Location: ./profilRouteur.php?profil=profil');
      
        } else {
          $_SESSION['identification'] = "Le mot de passe n'a pu être changé";
          header('Location: ./profilRouteur.php?profil=profil');
        
        }
      }
    } else {
      $_SESSION['identification'] = "Le mot de passe ne correspond pas";
      header('Location: ./profilRouteur.php?profil=profil');
  
    }
  } else {
    $_SESSION['identification'] = "Il manque des informations";
    header('Location: ./profilRouteur.php?profil=profil');

  }
}

/**
 * Change user's pseudo in database
 */
function changePseudo($pseudo) {
  if (isset($_POST['newPseudo']) && isset($_POST['pass']) && !empty($_POST['pass']) && !empty($_POST['newPseudo'])) {
    $newPseudo = htmlspecialchars($_POST['newPseudo']);
    $pass = htmlspecialchars($_POST['pass']);

    // On vérifie que le profil existe
    $dataProfil = rqProfil($pseudo);

    if (!$dataProfil) {
      $_POST['newPseudo'] = null;
      $_POST['pass'] = null;
      $_SESSION['identification'] = 'Erreur de pseudo ou de mot de passe...';
      header('Location: index.php');

    } else {
      // On vérifie que le pseudo n'est pas déjà pris !
      $dataProfilNewPseudo = rqProfil($newPseudo);

      if ($dataProfilNewPseudo) {
        $_SESSION['identification'] = "Ce pseudo est déjà pris";
        header('Location: ./profilRouteur.php?profil=profil');

      } else {
        // Comparaison pass envoyé et celui dans la base.
        $is_pass_correct = password_verify($pass, $dataProfil['mdp']);

        // Comparaison mdp saisi et celui en bdd
        if ($is_pass_correct) {
          // On change le pseudo dans profil
          $affectedLines = insertNewPseudo($pseudo, $newPseudo);

          if ($affectedLines) {
            // On change le pseudo dans course_multiplication
            $affectedLines = changeIdCoureur($pseudo, $newPseudo);

            // On change le nom du fichier avatar
            $avatarPath = "./avatars/mini_".$pseudo.".png";
            $newAvatarPath = "./avatars/mini_".$newPseudo.".png";
            $avatarIsRenamed = rename($avatarPath, $newAvatarPath);

            if (!$avatarIsRenamed) {
              // On renvoi la session avec le nouveau pseudo          
              $_SESSION['pseudo'] = $newPseudo;
              $_SESSION['identification'] = "L'avatar n'a pu être mis à jour";
              header('Location: ./profilRouteur.php?profil=profil');

            } else {
              // On renvoi la session avec le nouveau pseudo          
              $_SESSION['pseudo'] = $newPseudo;
              header('Location: ./profilRouteur.php?profil=profil');

            }
          } else {
            $_SESSION['identification'] = "Le pseudo n'a pu être changé";
            header('Location: ./profilRouteur.php?profil=profil');
          
          }
        } else {
          $_SESSION['identification'] = "Le mot de passe ne correspond pas";
          header('Location: ./profilRouteur.php?profil=profil');

        }
      }
    }
  } else {
    $_SESSION['identification'] = "Il faut renseigner un nouveau pseudo et le mot de passe";
    header('Location: ./profilRouteur.php?profil=profil');

  }
}

/**
 * Change scenery
 */
function changeStyle($pseudo) {
  if (isset($_POST['style'])) {
    $newStyle = htmlspecialchars($_POST['style']);
    $affectedLines = insertNewStyle($pseudo, $newStyle);

    if ($affectedLines) {
      $_SESSION['style'] = $newStyle;
      header('Location: ./profilRouteur.php?profil=profil');
  
    } else {
      $_SESSION['identification'] = "L'ambiance n'a pu être changée";
      header('Location: ./profilRouteur.php?profil=profil');
    
    }
  } else {
    $_SESSION['identification'] = "Pas d'ambiance choisie";
    header('Location: ./profilRouteur.php?profil=profil');

  }
}


/**
 * Get user's profil infos
 */
function getProfilInfo($pseudo) {
  $dataProfil = rqProfil($pseudo);

  if (!$dataProfil) {
    $_SESSION['identification'] = 'Problème d\'identification';
  }

  return $dataProfil;
}


/**
 * Displays privacy policy view
 */
function confidentialiteView () {

  $pseudo = htmlspecialchars($_SESSION['pseudo']);
  require("view/confidentialite/confidentialite.php");
}

/**
 * Displays contact view
 */
function contactView () {

  $pseudo = htmlspecialchars($_SESSION['pseudo']);
  require("view/contact/contact.php");
}
