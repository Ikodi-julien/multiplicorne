<?php
$title = "Multiplicorne - Profil";
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
        <h2>Avatar actuel :
          <img 
          src="<?php
          if (isset($_SESSION['avatar'])) {
            echo './public/images/'. $_SESSION['avatar'] .'.png'; 
          } else {
            echo 'problème Session';
          }?>" 
          alt="Pas d'image d'avatar"
          >
        </h2>
      </div>

      <div class="content__profil__items__card__toggle avatarProfil shrink">
        <h3 id="avatarProfilToggle">Changer d'avatar </h3>
        <form 
        action="profilRouteur.php?profil=modifyAvatar" method="post">
          <label for="licorne">Licorne<input type="radio" name="avatar" id="licorne" value="licorne"></label>
          <label for="dinosaure">Dinosaure<input type="radio" name="avatar" id="dinosaure" value="dinosaure"></label>
          <label for="chevalier">Chevalier<input type="radio" name="avatar" id="chevalier" value="chevalier"></label>
          <label for="McQueen">McQueen<input type="radio" name="avatar" id="McQueen" value="McQueen"></label>
          <input type="submit" value="Changer l'avatar">
        </form>
      </div>
    </div>    

    <!-- STYLE -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">
        <h2>Choix du décor :</h2>
      </div>

      <div class="content__profil__items__card__toggle decorProfil shrink">

        <h3 id="decorProfilToggle">Choisir l'ambiance</h3>

        <form action="profilRouteur.php?profil=modifyStyle" method="post">
          <label for="rose">Plutôt rose<input type="radio" name="style" id="rose" value="licorne.css"></label>
          <label for="neutre">Plutôt bleu - jaune<input type="radio" name="style" id="neutre" value="neutre.css"></label>
          <label for="high_contrast">Moins lumineux<input type="radio" name="style" id="high_contrast" value="high_contrast.css"></label>
          <input type="submit" value="Modifier l'ambiance">
        </form>
      </div>
    </div>

    <!-- PROFIL PHOTO -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">
        <h2>Photo actuelle :
            <img 
            src="<?php echo './public/avatars/mini_'.$pseudo.'.png'; ?>" 
            alt="Pas d'image de pseudo"
            >
        </h2>
      </div>
      
      <div class="content__profil__items__card__toggle photoProfil shrink">
        <h3 id="photoProfilToggle">Changer la photo </h3>
        <p>Choisissez une image ou photo, de préférence carrée ;-)</p>
        <form 
        action="profilRouteur.php?profil=setProfilPhoto" 
        method="post" 
        enctype="multipart/form-data">
          <input type="file" name="avatar_fichier" id="avatar_fichier"><br />
          <input type="submit" value="Envoyer le fichier"><br />
        </form>
      </div>
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

      <div class="content__profil__items__card__toggle birthDateProfil shrink">
        <h3 id="birthDateProfilToggle">Saisir la date de naissance </h3>
        <form 
        class="content__profil__items__card__item"
        action="profilRouteur.php?profil=newBirthDate" method="post">
          <input type="date" name="newBirthDate" id="newBirthDate">
          <input type="submit" value="Envoyer">
        </form>

      </div>
    </div>

    <!-- PSEUDO -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">          
        <h2>Pseudo actuel :</h2>
        <?php
          echo '<p class="content__profil__items__card__item">'.$pseudo.'</p>';
            ?>
      </div>

      <div class="content__profil__items__card__toggle pseudoProfil shrink">
        <h3 id="pseudoProfilToggle">Changer de pseudo </h3>
        <form 
          action="profilRouteur.php?profil=newPseudo" method="post">
            <p>Attention, tous les temps enregistrés avec l'ancien pseudo seront perdus !<br/>
            Mot de passe : </p>
            <input type="password" name="pass" id="pass">
            <p>Nouveau pseudo : </p>
            <input type="text" name="newPseudo" id="newPseudo">
            <input type="submit" value="Envoyer">
        </form>
      </div>
    </div>

    <!-- EMAIL -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">
        <h2>eMail (récup mot de passe) :</h2>
        <?php
          echo '<p class="content__profil__items__card__item">'. $profilInfo['email'] .'</p>';
            ?>
      </div>

      <div class="content__profil__items__card__toggle emailProfil shrink">

        <h3 id="emailProfilToggle">Changer l'email</h3>

        <form 
        class="content__profil__items__card__item"
        action="profilRouteur.php?profil=newEmail" method="post">

          <p>Saisir le nouvel email :</p>
          <input type="email" name="new-email" id="new_email">
          <input type="submit" value="Envoyer">
        </form> 
      </div>
    </div>

    <!-- PASSWORD -->
    <div class="content__profil__items__card">
      <div class="content__profil__items__card__item">          
        <h2>Changement de mot de passe :</h2>
      </div>

      <div class="content__profil__items__card__toggle passProfil shrink">
        <h3 id="passProfilToggle">Changer de mot de passe</h3>
        <form 
          action="profilRouteur.php?profil=newPass" method="post">
          <label for=pass>Mot de passe actuel : 
          <input type="password" name="pass" id="pass"></label>
          <label for="newPass1">Nouveau mot de passe : 
          <input type="text" name="newPass1" id="newPass1"></label>
          <label for="newPass2">2ème fois nouveau mot de passe : 
          <input type="text" name="newPass2" id="newPass2"></label>
          <input type="submit" value="Envoyer">
        </form>
      </div>
    </div>

  </div>
</section>

<?php $content = ob_get_clean();
require('./view/template.php');
?>