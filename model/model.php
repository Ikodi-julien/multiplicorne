<?php

/** 
 * --- SQL FUNCTIONS ---
 */

/**
 * Se connecte à la base de données
 */
function dbConnect () {
  try {
    $db = new PDO(
        'mysql:host=localhost;dbname=multipli;charset=utf8',
        'licorne',
        'Planche7139',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
  } catch (Exception $e) {
      die('Erreur : '.$e->getMessage());
  }
  return $db;
}

/*----------------------------------------------*/
/*----------------------------------------------*/
/*------------- LOGIN --------------------------*/
/*----------------------------------------------*/
/*----------------------------------------------*/
/**
 * Renvoi pseudo et mot de passe d'un profil
 */
function rqProfil ($pseudo) {

  $db = dbConnect();

  $rqProfil = $db->prepare('
  SELECT pseudo, mdp, email, birth_date, style, avatar 
  FROM Profil 
  WHERE pseudo= ?
  ');
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

/*----------------------------------------------*/
/*----------------------------------------------*/
/*----------- RACE TIME ------------------------*/
/*----------------------------------------------*/
/*----------------------------------------------*/

/**
 * Insert a race time in database
 */
function insertTime($pseudo, $raceType, $operationType, $table, $mixed, $duration) {

  $db = dbConnect();
  $rqRecord = $db->prepare(
    "INSERT INTO course_multiplication(id_coureur, race_type, operation_type, table_multiplication, melange, temps_course) 
  VALUES (:id_coureur, :race_type, :operation_type, :table_multiplication, :melange, :temps_course)");

  $affectedLines = $rqRecord->execute(array(
      'id_coureur' => $pseudo,
      'race_type' => $raceType,
      'operation_type' => $operationType,
      'table_multiplication' => $table,
      'melange' => $mixed,
      'temps_course' => $duration
  ));

  return $affectedLines;

}

/**
 * Return all user' times for all races.
 */

function getAllTimes($pseudo) {
  $db = dbConnect();

  $rqTimes = $db->prepare("SELECT id, race_type, operation_type, temps_course, table_multiplication, melange, 
  DATE_FORMAT(date_course, ' le %d/%m/%Y') AS date_course 
  FROM course_multiplication 
  WHERE id_coureur= :id_coureur 
  ORDER BY id DESC");
  $rqTimes->execute(array(
      'id_coureur' => $pseudo,
  ));

  return $rqTimes;
}

function getAllRaceTimes($pseudo, $raceType, $operationType) {
  $db = dbConnect();

  $rqTimes = $db->prepare("SELECT id, race_type, operation_type, temps_course, table_multiplication, melange, 
  DATE_FORMAT(date_course, ' le %d/%m/%Y') AS date_course 
  FROM course_multiplication 
  WHERE id_coureur= :id_coureur
  AND race_type= :race_type
  AND operation_type= :operation_type
  ORDER BY id DESC");
  
  $rqTimes->execute(array(
      'id_coureur' => $pseudo,
      'race_type' => $raceType,
      'operation_type' => $operationType
  ));

  return $rqTimes;
}

/**
 * Returns the count for marathon races done by pseudo
 */
function getRaceCount($pseudo, $race, $operationType) {
  
  $db = dbConnect();
  
  $rqCount = $db->prepare(
    "SELECT COUNT(`id`) as race_count
    FROM course_multiplication
    WHERE id_coureur= :pseudo
    AND race_type= :race_type
    AND operation_type= :operation_type"
    );
    
  $rqCount->execute(array(
    'pseudo' => $pseudo,
    'race_type' => $race,
    'operation_type' => $operationType
  ));
    
  return $rqCount->fetchColumn();
  
}
/**
 * Return 10 last user' times for given race.
 */

function getTenLastTimes($pseudo, $raceType, $operationType) {
  $db = dbConnect();

  $rqTenLastTimes = $db->prepare("SELECT id, race_type, operation_type, temps_course, table_multiplication, melange,
  DATE_FORMAT(date_course, ' le %d/%m/%Y') AS date_course 
  FROM course_multiplication 
  WHERE id_coureur= :id_coureur 
  AND race_type= :race_type
  AND operation_type= :operation_type
  ORDER BY id DESC
  LIMIT 10");
  $rqTenLastTimes->execute(array(
      'id_coureur' => $pseudo,
      'race_type' => $raceType,
      'operation_type' => $operationType,
  ));

  return $rqTenLastTimes;
}


/**
 * Return best time for a race.
 */
function getBestTime($pseudo, $raceType, $operationType) {
  $db = dbConnect();

  $rqBestTime = $db->prepare("SELECT id, race_type, operation_type, temps_course, table_multiplication, melange,
  DATE_FORMAT(date_course, ' le %d/%m/%Y') AS date_course 
  FROM course_multiplication 
  WHERE id_coureur= :id_coureur 
  AND race_type= :race_type
  AND operation_type= :operation_type
  ORDER BY temps_course
  LIMIT 1;
  ");
  
  $rqBestTime->execute(array(
      'id_coureur' => $pseudo,
      'race_type' => $raceType,
      'operation_type' => $operationType,
  ));

  return $rqBestTime->fetch();
}

/**
 * Returns the best time for a given table of multiplication
 */
function getBestTimeForOneTable($pseudo, $table) {
  $db = dbConnect();

  $rqBestTime = $db->prepare("SELECT id, race_type, operation_type, temps_course, table_multiplication, melange,
  DATE_FORMAT(date_course, ' le %d/%m/%Y') AS date_course 
  FROM course_multiplication 
  WHERE id_coureur= :id_coureur 
  AND race_type= 'sprint'
  AND `table_multiplication`= :tableMulti
  ORDER BY temps_course
  LIMIT 1;
  ");
  
  $rqBestTime->execute(array(
      'id_coureur' => $pseudo,
      'tableMulti' => strval($table)
  ));

  return $rqBestTime->fetch();
}

/**
 * Returns 10 last sprint from given table
 */
function getLastMultipliSprint($pseudo, $table) {
  
  $db = dbConnect();
  $rq = $db->prepare(
    "SELECT id, race_type, operation_type, temps_course, table_multiplication, melange, 
    DATE_FORMAT(date_course, ' le %d/%m/%Y') AS date_course 
    FROM course_multiplication 
    WHERE id_coureur=:id_coureur 
    AND race_type='sprint'
    AND operation_type='multipli'
    AND `table_multiplication`=:tableMultipli
    LIMIT 10"
  );
  
  $rq->execute(array(
    'id_coureur' => $pseudo,
    'tableMultipli' => strval($table)
  ));
  
  return $rq;
    
}


/*----------------------------------------------*/
/*----------------------------------------------*/
/*--------------- PROFIL FUNCTIONS -------------*/
/*----------------------------------------------*/
/*----------------------------------------------*/

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


function insertNewAvatar($pseudo, $newAvatar) {
  $db = dbConnect();

  $rqNewAvatar = $db->prepare("UPDATE Profil
  SET avatar=:newAvatar
  WHERE pseudo=:pseudo");

  $affectedLines = $rqNewAvatar->execute(array(
      'pseudo' => $pseudo,
      'newAvatar' => $newAvatar,
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

function insertNewStyle($pseudo, $newStyle) {
  $db = dbConnect();

  $rqNewStyle = $db->prepare("UPDATE Profil
  SET style=:newStyle
  WHERE pseudo=:pseudo");

  $affectedLines = $rqNewStyle->execute(array(
      'pseudo' => $pseudo,
      'newStyle' => $newStyle,
  ));

  return $affectedLines;
}

function insertNewBirthDate($pseudo, $newBirthDate) {
  $db = dbConnect();

  $rqNewBirthDate = $db->prepare("UPDATE Profil
  SET birth_date=:birthDate
  WHERE pseudo=:pseudo");

  $affectedLines = $rqNewBirthDate->execute(array(
      'pseudo' => $pseudo,
      'birthDate' => $newBirthDate,
  ));

  return $affectedLines;
}

function insertNewPseudo($pseudo, $newPseudo) {
  $db = dbConnect();

  $rqNewPseudo = $db->prepare("UPDATE Profil
  SET pseudo=:newPseudo
  WHERE pseudo=:pseudo");

  $affectedLines = $rqNewPseudo->execute(array(
      'pseudo' => $pseudo,
      'newPseudo' => $newPseudo,
  ));

  return $affectedLines;
}

function insertNewPass($passHache, $pseudo) {
  $db = dbConnect();

  $rqNewPass = $db->prepare("UPDATE Profil
  SET mdp=:mdp
  WHERE pseudo=:pseudo");

  $affectedLines = $rqNewPass->execute(array(
      'pseudo' => $pseudo,
      'mdp' => $passHache,
  ));

  return $affectedLines;
}

function changeIdCoureur($pseudo, $newPseudo) {

  $db = dbConnect();
  $rqChangeIdCoureur = $db->prepare("UPDATE course_multiplication
  SET id_coureur=:newPseudo
  WHERE id_coureur=:pseudo");

  $affectedLines = $rqChangeIdCoureur->execute(array(
      'pseudo' => $pseudo,
      'newPseudo' => $newPseudo,
  ));

  return $affectedLines;
}
