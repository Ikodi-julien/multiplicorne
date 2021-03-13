<?php
/**
 * Returns how many was done for the given $race
 */
function userRaceCountCtrl($pseudo, $race, $operationType) {
  
  $count = getRaceCount($pseudo, $race, $operationType);
  
  return $count;
}

/**
 * Returns the best race for type and operation given
 */
function userBestRaceCtrl($pseudo, $raceType, $operationType) {
  
  $bestRace = getBestTime($pseudo, $raceType, $operationType);
  
  return $bestRace;
}
/**
 * get all user' times
 */

function userTimesCtrl($pseudo) {

  $rqTimes = getAllTimes($pseudo);
  $timesData = [];
  
  while ($data = $rqTimes->fetch(PDO::FETCH_ASSOC)) {
    
    $timesData[] = $data;
  };

  return $timesData;
}

function userLastRaceTimesCtrl($pseudo, $race, $operationType) {

  $rqTimes = getTenLastTimes($pseudo, $race, $operationType);
  $timesData = [];
  
  while ($data = $rqTimes->fetch(PDO::FETCH_ASSOC)) {
    
    $timesData[] = $data;
  };

  return $timesData;
}

/**
 * Returns 10 last multipli sprint for each table from 2 to 9
 */
function userAllSprintMultipli($pseudo) {
  
  $dataLists=[];
  
  for ($table = 2; $table < 10; $table++) {
    $tableSprint = array();
    
  // Pour chaque table récupérer le meilleur temps
    $bestTime = getBestTimeForOneTable($pseudo, $table);
  
    $tableSprint['best_time'] = $bestTime;
    
  // Puis récupérer les 10 derniers temps
    $rq = getLastMultipliSprint($pseudo, $table );
    
    while ($data = $rq->fetch(PDO::FETCH_ASSOC)) {
      $tableSprint[] = $data;
    }
    
    $dataLists[] = $tableSprint;
  }
  
  return $dataLists;
}