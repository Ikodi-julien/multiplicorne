<?php $title = "Choisi un pseudo";
ob_start(); ?>
  <h3>Choisi un pseudo et un mot de passe.</h3>
  <form action="./index.php" method="post">
      <p>Pseudonyme : </p>
      <input type="text" name="newPseudo" id="newPseudo"><br />
      <p>Mot de passe : </p>
      <input type="password" name="newMdp1" id="mdp"><br />
      <p>Saisir à nouveau le mot de passe : </p>
      <input type="password" name="newMdp2" id="mdp"><br /><br />
      <p>La saisie de l'email n'est pas obligatoire, mais vous ne pourrez pas récupérer un mot de passe perdu, ça aurit été sa seule utilité.</p><br />
      <p>Email : </p>
      <input type="email" name="email_1" id="email_1"><br />
      <p>Saisir à nouveau l'email : </p>
      <input type="email" name="email_2" id="email_2"><br />
      <button type="submit" >Valider</button>
      <a href="index.php">Retour à l'accueil</a>
  </form></br>
<?php $content = ob_get_clean();
require("./view/loginViews/templateLogin.php"); ?>