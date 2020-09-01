<?php
// --- SQL FUNCTIONS --- //
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

  $rqProfil = $db->prepare('SELECT pseudo, mdp FROM Profil WHERE pseudo= ?');
  $rqProfil->execute(array($pseudo));
  $dataProfil = $rqProfil->fetch();
  $rqProfil->closeCursor();

  return $dataProfil;
}

/**
 * Insert a profil (pseudo and password) in data base.
 */
function setNewProfil ($pseudo, $pass) {
  $db = dbConnect();

  $rqNewProfil = $db->prepare('INSERT INTO Profil(pseudo, mdp) VALUES (:newPseudo, :newMdp)');

  $rqNewProfil->execute(array(
      'newPseudo' => $pseudo,
      'newMdp' => $pass,
  ));
}

/**
 * Return all user' times for all races.
 */

function getTimes($pseudo) {
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

function displayTimes($rqTimes) {
  while ($data = $rqTimes->fetch()) {
    echo '<h3>Table : '.$data['table_multiplication'].' '.$data['melange'].' en '.$data['temps_course'].$data['date_course'].'</h3><br />';
  };
}