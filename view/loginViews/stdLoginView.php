<?php $title = "Login";
ob_start(); ?>

  <h3>Connecte-toi si tu veux enregistrer tes temps</h3>
  <form action="./index.php" method="post">
      <p>Pseudonyme : </p>
      <input type="text" name="pseudo" id="pseudo"><br />
      <p>Mot de passe : </p>
      <input type="password" name="mdp" id="mdp"><br />
      <button type="submit" >Valider</button>
  </form></br>
  <a href="index.php?info_login=premiere" >Pas encore d'identifiant ?</a>
  <a href="index.php?info_login=perdu_mdp" >Mot de passe perdu ?</a>
  <a href="index.php?info_login=visiteur"><button>Je viens juste faire un essai</button></a>
  
<?php $content = ob_get_clean();
require("./view/loginViews/templateLogin.php"); ?>
