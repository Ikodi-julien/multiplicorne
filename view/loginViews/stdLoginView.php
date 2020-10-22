<?php $title = "Connexion Multiplicorne";
ob_start(); ?>

  <h3>Connecte-toi si tu veux enregistrer tes temps</h3>
  <form action="./index.php" method="post">
      <p>Pseudonyme : </p>
      <input type="text" name="pseudo" id="pseudo"><br />
      <p>Mot de passe : </p>
      <input type="password" name="mdp" id="mdp"><br />
      <label for="auto">Rester connecté.e
        <input type="checkbox" name="auto" id="auto"></label><br />
      <button type="submit" >Valider</button>
  </form></br>
  <div class="login__content__sepH"></div>
  <a href="index.php?info_login=premiere" ><button>Créer un compte</button></a>
  <a href="index.php?info_login=perdu_mdp" ><button>Récupérer mon mot de passe</button></a>
  <br />
  <div class="login__content__sepH"></div>
  <a href="index.php?info_login=visiteur"><button>Je viens juste faire un essai</button></a>
  
<?php $content = ob_get_clean();
require("./view/loginViews/templateLogin.php"); ?>
