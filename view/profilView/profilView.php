<?php
$title = "PROFIL";
$js = "";

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
      
      <img 
      src="<?php echo './avatars/mini_'.$pseudo.'.png'; ?>" 
      alt="Pas d'image de pseudo"
      >
      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=setAvatar" 
      method="post" 
      enctype="multipart/form-data">
      <p>Choisir un autre avatar :<br />
          <input type="file" name="avatar_fichier" id="avatar_fichier"><br />
          <input type="submit" value="Envoyer le fichier"><br />
      </p>
      </form>
    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">eMail pour récupération du mot de passe :</h2>
      <?php
        echo '<p class="content__profil__items__card__item">'.$profilInfo['email'].'</p>';
        if (isset($modif) && $modif == 'email') { 
          ?>
        <form 
        class="content__profil__items__card__item"
        action="profilRouteur.php?profil=newEmail" method="post">

        <p>Saisir le nouvel email :</p>
          <input type="email" name="new-email" id="new_email">
          <input type="submit" value="Envoyer">
        </form>
        
        <?php } else { ?>
      <a href="profilRouteur.php?profil=modifyEmail"><button>Modifier</button></a>
        <?php }?>
    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Date de naissance :</h2>
      <?php
        if ($profilInfo['birth_date'] != "") {
        echo '<p class="content__profil__items__card__item">'.$profilInfo['birth_date'].'</p>';

        } else {
        echo '<p class="content__profil__items__card__item">La date de naissance n\'est pas renseignée</p>';

        }

        if (isset($modif) && $modif == 'birthDate') { 
          ?>
        <form 
        class="content__profil__items__card__item"
        action="profilRouteur.php?profil=newBirthDate" method="post">
          <input type="date" name="newBirthDate" id="newBirthDate">
          <input type="submit" value="Envoyer">
        </form>

        <?php } else { ?>
      <a href="profilRouteur.php?profil=modifyBirthDate"><button>Modifier</button></a>
        <?php }?>
    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Pseudo actuel :</h2>
      <?php
        echo '<p class="content__profil__items__card__item">'.$pseudo.'</p>';
        if (isset($modif) && $modif == 'pseudo') { 
          ?>
        <form 
        class="content__profil__items__card__item"
        action="profilRouteur.php?profil=newPseudo" method="post">
          <p>Saisir le mot de passe : </p>
          <input type="password" name="pass" id="pass">
          <p>Saisir le nouveau pseudo : </p>
          <input type="text" name="newPseudo" id="newPseudo">
          <input type="submit" value="Envoyer">
        </form>

        <?php } else { ?>
        <a href="profilRouteur.php?profil=modifyPseudo"><button>Modifier</button></a>
        <?php }?>

    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Changement de mot de passe :</h2>
      <?php
      if (isset($modif) && $modif == 'pass') { 
        ?>
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
        <?php } else { ?>
      <a href="profilRouteur.php?profil=modifyPass"><button>Changer</button></a>
        <?php }?>
    </div>

    <div class="content__profil__items__card">
      <h2 class="content__profil__items__card__item">Choix du style :</h2>
      <form 
      class="content__profil__items__card__item"
      action="profilRouteur.php?profil=modifyStyle" method="post">
        <label for="style">Multiplicorne</label><input type="radio" name="style" id="style" value="style.css">
        <label for="style_2">Style 2</label><input type="radio" name="style" id="style_2" value="style_2.css">
        <label for="style_3">Style 3</label><input type="radio" name="style" id="style_3" value="style_3.css">
        <input type="submit" value="Modifier l'ambiance">

      </form>
    </div>

  </div>

  
</section>

<?php $content = ob_get_clean();
require('./view/template.php');
?>