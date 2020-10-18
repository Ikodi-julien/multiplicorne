<?php
$title = "PROFIL";
$js = "<script src=\"./scripts/profil.js\" type=\"module\"></script>";
ob_start(); ?>

<section class="content__profil">

  <h1 class='content__profil__title'>Profil de  
    <?php 
    if (isset($_SESSION['pseudo'])) {
      $pseudo = htmlspecialchars($_SESSION['pseudo']);
      echo $pseudo; }
    ?></h1>

  <div class="content__profil__items">

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Avatar actuel :</h2>
      
      <div class="content__profil__items__card__item__avatar">
      <img 
      src="<?php echo './avatars/mini_'.$pseudo.'.png'; ?>" 
      alt="Pas d'image de pseudo"
      >
      </div>

      <div class="front1 extend">
        <h3 class="toggle">Choisir un autre avatar </h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=setAvatar" 
      method="post" 
      enctype="multipart/form-data">
          <input type="file" name="avatar_fichier" id="avatar_fichier"><br />
          <input type="submit" value="Envoyer le fichier"><br />
      </form>
      
    </div>


    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">eMail pour récupération du mot de passe :</h2>
      <?php
        echo '<p class="content__profil__items__card__item">'. $profilInfo['email'] .'</p>';
          ?>

      <div class="front2 extend">
        <h3 class="toggle">Choisir un autre avatar </h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=newEmail" method="post">

        <p>Saisir le nouvel email :</p>
        <input type="email" name="new-email" id="new_email">
        <input type="submit" value="Envoyer">
      </form>
        
      <a href="profilRouteur.php?profil=modifyEmail"><button>Modifier</button></a>
    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Date de naissance :</h2>
      <?php
        if ($profilInfo['birth_date'] != "") {
        echo '<p class="content__profil__items__card__item">'.$profilInfo['birth_date'].'</p>';

        } else {
        echo '<p class="content__profil__items__card__item">La date de naissance n\'est pas renseignée</p>';

        }
          ?>

      <div class="front3 extend">
        <h3 class="toggle">Choisir un autre avatar </h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=newBirthDate" method="post">
        <input type="date" name="newBirthDate" id="newBirthDate">
        <input type="submit" value="Envoyer">
      </form>

      <a href="profilRouteur.php?profil=modifyBirthDate"><button>Modifier</button></a>
    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Pseudo actuel :</h2>
      <?php
        echo '<p class="content__profil__items__card__item">'.$pseudo.'</p>';
          ?>

      <div class="front4 extend">
        <h3 class="toggle">Choisir un autre avatar </h3>
      </div>

      <form 
        class="content__profil__items__card__item"
        action="profilRouteur.php?profil=newPseudo" method="post">
          <p>Saisir le mot de passe : </p>
          <input type="password" name="pass" id="pass">
          <p>Saisir le nouveau pseudo : </p>
          <input type="text" name="newPseudo" id="newPseudo">
          <input type="submit" value="Envoyer">
      </form>

      <a href="profilRouteur.php?profil=modifyPseudo"><button>Modifier</button></a>

    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Changement de mot de passe :</h2>

      <div class="front5 extend">
        <h3 class="toggle">Choisir un autre avatar </h3>
      </div>

      <form 
        class="content__profil__items__card__item"
        action="profilRouteur.php?profil=newPass" method="post">
          <p>Saisir le mot de passe actuel : </p>
          <input type="password" name="pass" id="pass">
          <p>Saisir le nouveau mot de passe : </p>
          <input type="text" name="newPass1" id="newPass1">
          <p>Saisir à nouveau le nouveau mot de passe : </p>
          <input type="text" name="newPass2" id="newPass2">
          <input type="submit" value="Envoyer">
        </form>
      <a href="profilRouteur.php?profil=modifyPass"><button>Changer</button></a>
    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Choix du style :</h2>

      <div class="front6 extend">
        <h3 class="toggle">Choisir un autre avatar </h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=modifyStyle" method="post">
        <label for="style">Plutôt rose</label><input type="radio" name="style" id="style" value="style.css">
        <label for="style_2">Plutôt bleu</label><input type="radio" name="style" id="style_2" value="style_2.css">
        <label for="style_3">Style 3</label><input type="radio" name="style" id="style_3" value="style_3.css">
        <input type="submit" value="Modifier l'ambiance">
      </form>
    </div>

  </div>
</section>

<?php $content = ob_get_clean();
require('./view/template.php');
?>