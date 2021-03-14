<?php
require('phpMailer.php');

function disconnect() {
  
    $_SESSION = array();
    session_destroy();
    setcookie('pseudo', '');
    setcookie('pass_hache', '');

    $_GET['deconnexion'] = null;
    header("Location: index.php?info_login=disconnected");
}
