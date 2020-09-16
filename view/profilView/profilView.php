<?php
$title = "PROFIL";
$js = "";
$css = "css/style.css";

ob_start(); ?>

<section class="content__profil">

  <h1 class='content__profil__title'>Profil de  
    <?php 
    if (isset($_SESSION['pseudo'])) {
      $pseudo = htmlspecialchars($_SESSION['pseudo']);
      echo $pseudo; }
    ?></h1>

  <div class="content__profil__items">
    <div class="content__profil__items__item">
      <h2>Avatar</h2>
      <p>Avatar actuel :</p>
      
      <img src="<?php echo './avatars/mini_'.$pseudo.'.png'; ?>" alt="Pas d'image de pseudo">
      <form action="index.php?profil=setAvatar" method="post" enctype="multipart/form-data">
      <p>Choisir un autre avatar :<br />
          <input type="file" name="avatar_fichier" id="avatar_fichier"><br />
          <input type="submit" value="Envoyer le fichier"><br />
      </p>
      </form>
    </div>

    <!-- <div class="content__profil__items__item">
      <h2>eMail</h2>
      <?php
        echo '<p>'.$infos['email'].'</p>';
        if (isset($modif) && $modif == 'email') { 
          ?>
        <form action="modification_profil.php" method="post">
        <p>Saisir le nouvel email :</p>
          <input type="email" name="new_email" id="new_email">
          <input type="submit" value="Envoyer">
        </form>
      <?php };?>
      <a href="profil.php?modif=email">Modifier l'email</a>
    </div>

    <div class="content__profil__items__item">
    <h2>Date de naissance</h2>
    <?php
        echo '<p>'.$infos['date_naissance'].'</p>';
        if (isset($modif) && $modif == 'birth_date') { 
          ?>
        <form action="modification_profil.php" method="post">
          <input type="date" name="birth_date" id="birth_date">
          <input type="submit" value="Envoyer">
        </form>
      <?php };?>
      <a href="profil.php?modif=birth_date">Modifier la date de naissance</a>
    </div>

    <div class="content__profil__items__item">
      <h2>Identifiants</h2>

      <p>Pseudo actuel :</p>
      <?php
        echo '<p>'.$infos['pseudo'].'</p>';
        if (isset($modif) && $modif == 'new_pseudo') { 
          ?>
        <form action="modification_profil.php" method="post">
          <p>Saisir le mot de passe : </p>
          <input type="password" name="pass" id="pass">
          <p>Saisir le nouveau pseudo : </p>
          <input type="text" name="new_pseudo" id="birth_date">
          <input type="submit" value="Envoyer">
        </form>
        <?php }?>
        <a href="profil.php?modif=new_pseudo">Modifier le pseudo</a>
      
      <p>Changement mot de passe</p>
      <?php
      if (isset($modif) && $modif == 'new_pass') { 
        ?>
        <form action="modification_profil.php" method="post">
          <p>Saisir le mot de passe : </p>
          <input type="password" name="pass" id="pass">
          <p>Saisir le nouveau mot de passe : </p>
          <input type="text" name="new_pass" id="new_pass">
          <input type="submit" value="Envoyer">
        </form>
        <?php } ?>
      <a href="profil.php?modif=new_pass">Modifier le mdp</a>
    </div>

    <div class="content__profil__items__item">
      <h2>Choix du style :</h2>
      <form action="modification_profil.php" method="post">
        <p>Choisir le style</p>
        <label for="style">De base</label><input type="radio" name="style" id="style" value="style.css">
        <label for="style">Style 2</label><input type="radio" name="style" id="style" value="style2.css">
        <label for="style">Style 3</label><input type="radio" name="style" id="style" value="style3.css">
        <input type="submit" value="Envoyer le style">
        <?php
        if (isset($_GET['ok_cookie'])) {
          echo '<p>Changement de style effectué</>';
        } ?>
      </form> -->
    </div>
  </div>

  
</section>

<?php $content = ob_get_clean();
require('./view/template.php');
?>