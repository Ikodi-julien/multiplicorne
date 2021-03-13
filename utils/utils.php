<?php

  
// $races = ['Toutes', '9', '8', '7', '6', '5', '4', '3', '2'];
    
//     for ($index = 0; $index< count($races) ; $index++) { 
        
//     $times = rqTenLastTimes($pseudo, $races[$index]);
//     // echo 'ok 3';
//     $bestTime = rqBestTime($pseudo, $races[$index]);
//     // echo 'ok 4';
    
//     if ($bestTime) {
        
//         echo '<h2>Table : '.$races[$index]. '</h2>';
            
//         if ($bestTime['table_multiplication'] === 'Toutes ') {
//             $bestTime['table_multiplication'] = "Le Marathon !";
            
//         }
        
//         $bestTimeString = floor($bestTime['temps_course'] / 60) . 'mn ' .  floor($bestTime['temps_course'] % 60) . 's ';

//         echo '<h3>Meilleur temps : '. $bestTimeString . $bestTime['date_course']. '</h3>';
        
//         while ($data = $times->fetch()) { 
            
//             if (floor($data['temps_course'] / 60)) {
//                 $timeToString = floor($data['temps_course'] / 60) . 'mn ' .  floor($data['temps_course'] % 60) . 's ';
//             } else {
//                 $timeToString = floor($data['temps_course'] % 60) . 's ';
//             }
//         
            

function disconnect() {
  
    $_SESSION = array();
    session_destroy();
    setcookie('pseudo', '');
    setcookie('pass_hache', '');

    $_GET['deconnexion'] = null;
    header("Location: index.php?info_login=disconnected");
}

/**
 * --- PHPMailer
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($mailTo, $pseudo, $subject, $message) {

  require './vendor/autoload.php';

  $mail = new PHPMailer(TRUE);
  /* ... */
  try {
    $mail->setFrom('multiplicorne@gmail.com', 'Multiplicorne');
    $mail->addAddress($mailTo, $pseudo);
    $mail->Subject = $subject;
    $mail->Body = $message;

    /* SMTP parameters. */

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'multiplicorne@gmail.com';
    $mail->Password = 'multiplicornePlanche7139!';
    $mail->Port = 587;

    /* Disable some SSL checks. */
    $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
    );

    /* Enable SMTP debug output, dev purpose only, delete in production */
    // $mail->SMTPDebug = 4;

    /* Finally send the mail. */
    $mail->send();

    return true;
  }
  catch (Exception $e)
  {
    /* PHPMailer exception. */
    echo $e->errorMessage();
  }
  catch (\Exception $e)
  {
    /* PHP exception (note the backslash to select the global namespace Exception class). */
    echo $e->getMessage();
  }
}