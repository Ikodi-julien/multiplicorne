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
 * Enregistre un pseudo et son mot de passe dans la base de données
 */
function setNewProfil ($pseudo, $pass) {
  $db = dbConnect();

  $rqNewProfil = $db->prepare('INSERT INTO Profil(pseudo, mdp) VALUES (:newPseudo, :newMdp)');

  $rqNewProfil->execute(array(
      'newPseudo' => $pseudo,
      'newMdp' => $pass,
  ));
}
