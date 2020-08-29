<?php
// --- SQL FUNCTIONS --- //

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

function rqProfil ($pseudo) {
  // Renvoi pseudo et mdp d'un profil

  $db = dbConnect();

  $rqProfil = $db->prepare('SELECT pseudo, mdp FROM Profil WHERE pseudo= ?');
  $rqProfil->execute(array($pseudo));
  $dataProfil = $rqProfil->fetch();
  $rqProfil->closeCursor();

  return $dataProfil;
}

function setNewProfil ($pseudo, $pass) {
  // Enregistre un pseudo et le mdp dans la bdd,
  $db = dbConnect();

  $rqNewProfil = $db->prepare('INSERT INTO Profil(pseudo, mdp) VALUES (:newPseudo, :newMdp)');

  $rqNewProfil->execute(array(
      'newPseudo' => $pseudo,
      'newMdp' => $pass,
  ));
}
