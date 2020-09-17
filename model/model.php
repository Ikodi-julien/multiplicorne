<?php
/** --- SQL FUNCTIONS --- //
 * 
 */

/**
 * Se connecte à la base de données
 */
function dbConnect () {
  try {
    $db = new PDO(
        'mysql:host=localhost;dbname=test;charset=utf8',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
  } catch (Exception $e) {
      die('Erreur : '.$e->getMessage());
  }
  return $db;
}

/**
 * Renvoi pseudo et mot de passe d'un profil
 */
function rqProfil ($pseudo) {

  $db = dbConnect();

  $rqProfil = $db->prepare('SELECT pseudo, mdp, email, birth_date, style FROM Profil WHERE pseudo= ?');
  $rqProfil->execute(array($pseudo));
  $dataProfil = $rqProfil->fetch();
  $rqProfil->closeCursor();

  return $dataProfil;
}

/**
 * Return user's password
 */
function rqPass($lostPass) {
  $db = dbConnect();

  $rqPass = $db->prepare('SELECT mdp FROM Profil WHERE pseudo= :pseudo');
  $rqPass->execute(array('pseudo' => $lostPass));
  $data = $rqPass->fetch();
  $rqPass->closecursor();

  return $data;
}

/**
 * Return all user' times for all races.
 */

function rqTimes($pseudo) {
  $db = dbConnect();

  $rqTimes = $db->prepare("SELECT temps_course, table_multiplication, melange, 
  DATE_FORMAT(date_course, ' le %d/%m/%Y à %Hh%i') AS date_course 
  FROM course_multiplication 
  WHERE id_coureur= :id_coureur 
  ORDER BY date_course DESC");
  $rqTimes->execute(array(
      'id_coureur' => $pseudo,
  ));

  return $rqTimes;
}

function insertNewProfil($newPseudo, $pass_hache, $email_1) {
  $db = dbConnect();

  $rqNewProfil = $db->prepare("INSERT INTO Profil(pseudo, mdp, email) 
  VALUES (:pseudo, :pass, :email)");

  $affectedLines = $rqNewProfil->execute(array(
      'pseudo' => $newPseudo,
      'pass' => $pass_hache,
      'email' => $email_1,
  ));

  return $affectedLines;
}

function insertNewEmail($pseudo, $email) {
  $db = dbConnect();

  $rqNewEmail = $db->prepare("UPDATE Profil
  SET email=:email
  WHERE pseudo=:pseudo");

  $affectedLines = $rqNewEmail->execute(array(
      'pseudo' => $pseudo,
      'email' => $email,
  ));

  return $affectedLines;
}

/**
 * Insert a race time in database
 */

function insertTime($pseudo, $table, $mixed, $duration) {

  $db = dbConnect();
  $rqRecord = $db->prepare("INSERT INTO course_multiplication(id_coureur, table_multiplication, melange, temps_course) 
  VALUES (:id_coureur, :table_multiplication, :melange, :temps_course)");

  $affectedLines = $rqRecord->execute(array(
      'id_coureur' => $pseudo,
      'table_multiplication' => $table,
      'melange' => $mixed,
      'temps_course' => $duration,
  ));

  return $affectedLines;

}

/**
 * --- DISPLAY FUNCTIONS ---
 */

function displayTimes($rqTimes) {
  while ($data = $rqTimes->fetch()) {
    echo '<p>Table : '.$data['table_multiplication'].' '.$data['melange'].' en '.$data['temps_course'].$data['date_course'].'</p><br />';
  };
}


function disconnect() {
  
    $_SESSION = array();
    session_destroy();
    setcookie('pseudo', '');
    setcookie('pass_hache', '');

    $_GET['deconnexion'] = null;
    header("Location: index.php?info_login=disconnected");
}
