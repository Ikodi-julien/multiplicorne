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

    <!-- AVATAR -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">
        <div class="avatar">
          <h2>Avatar actuel :</h2>
          <div class="content__profil__items__card__item__avatar">
            <img 
            src="<?php
            if (isset($_SESSION['avatar'])) {
              echo './images/'. $_SESSION['avatar'] .'.png'; 
            } else {
              echo 'problème Session';
            }?>" 
            alt="Pas d'image d'avatar"
            >
          </div>
        </div>
      </div>
      
      <div class="front7 extend">
          <h3 class="toggle7">Changer d'avatar </h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=modifyAvatar" method="post">
        <label for="licorne">Licorne</label><input type="radio" name="avatar" id="licorne" value="licorne">
        <label for="dinosaure">Dinosaure</label><input type="radio" name="avatar" id="dinosaure" value="dinosaure">
        <label for="chevalier">Chevalier</label><input type="radio" name="avatar" id="chevalier" value="chevalier">
        <label for="McQueen">McQueen</label><input type="radio" name="avatar" id="McQueen" value="McQueen">
        <input type="submit" value="Changer l'avatar">
      </form>
      
    </div>

    <!-- STYLE -->
    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Choix du décor :</h2>

      <div class="front6 extend">
        <h3 class="toggle6">Choisir l'ambiance</h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=modifyStyle" method="post">
        <label for="style">Plutôt rose</label><input type="radio" name="style" id="style" value="style.css">
        <label for="style_2">Plutôt bleu - jaune</label><input type="radio" name="style" id="style_2" value="style_2.css">
        <label for="style_3">Contraste élevé</label><input type="radio" name="style" id="style_3" value="style_3.css">
        <input type="submit" value="Modifier l'ambiance">
      </form>
    </div>

    <!-- PROFIL PHOTO -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">
        <div class="avatar">
          <h2>Photo actuelle :</h2>
          <div class="content__profil__items__card__item__avatar">
            <img 
            src="<?php echo './avatars/mini_'.$pseudo.'.png'; ?>" 
            alt="Pas d'image de pseudo"
            >
          </div>
        </div>
      </div>
      
      <div class="front1 extend">
          <h3 class="toggle1">Changer la photo </h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=setProfilPhoto" 
      method="post" 
      enctype="multipart/form-data">

          <input type="file" name="avatar_fichier" id="avatar_fichier"><br />
          <input type="submit" value="Envoyer le fichier"><br />
      </form>
      
    </div>

    <!-- BIRTH DATE -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">
        <h2>Date de naissance :</h2>
        <?php
          if ($profilInfo['birth_date'] != "") {
          echo '<p class="content__profil__items__card__item">'.$profilInfo['birth_date'].'</p>';

          } else {
          echo '<p class="content__profil__items__card__item">La date de naissance n\'est pas renseignée</p>';

          }
            ?>
      </div>

      <div class="front3 extend">
        <h3 class="toggle3">Saisir la date de naissance </h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=newBirthDate" method="post">
        <input type="date" name="newBirthDate" id="newBirthDate">
        <input type="submit" value="Envoyer">
      </form>

    </div>

    <!-- PSEUDO -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">          
        <h2>Pseudo actuel :</h2>
        <?php
          echo '<p class="content__profil__items__card__item">'.$pseudo.'</p>';
            ?>
      </div>

      <div class="front4 extend">
        <h3 class="toggle4">Changer de pseudo </h3>
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
    </div>

    <!-- EMAIL -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">
        <h2>eMail pour récupération du mot de passe :</h2>
        <?php
          echo '<p class="content__profil__items__card__item">'. $profilInfo['email'] .'</p>';
            ?>
      </div>

      <div class="front2 extend">
        <h3 class="toggle2">Choisir un autre email de récupération </h3>
      </div>

      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=newEmail" method="post">

        <p>Saisir le nouvel email :</p>
        <input type="email" name="new-email" id="new_email">
        <input type="submit" value="Envoyer">
      </form>
        
    </div>

    <!-- PASSWORD -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">          
        <h2>Changement de mot de passe :</h2>
      </div>

      <div class="front5 extend">
        <h3 class="toggle5">Changer de mot de passe</h3>
      </div>

      <form 
        class="content__profil__items__card__item"
        action="profilRouteur.php?profil=newPass" method="post">
          <p>Saisir le mot de passe actuel : </p>
          <input type="password" name="pass" id="pass">
          <p>Saisir le nouveau mot de passe : </p>
          <input type="text" name="newPass1" id="newPass1">
          <p>2ème saisie du nouveau mot de passe : </p>
          <input type="text" name="newPass2" id="newPass2">
          <input type="submit" value="Envoyer">
        </form>
    </div>

  </div>
</section>

<?php $content = ob_get_clean();
require('./view/template.php');
?>