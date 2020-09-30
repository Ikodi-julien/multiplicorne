<section class="content__header">

  <div class="content__header__title">
    <h1>Les multiplications, ça fait avancer les Licornes !</h1>

    <div class="content__header__title__profil">

      <div class="content__header__title__profil__avatar">

        <img src="./avatars/mini_<?php echo $pseudo;?>.png" alt="Image Profil">

        <div id="pseudo" class="content__header__title__profil__pseudo">
          <?php if (isset($_SESSION['pseudo'])) {
              $pseudo = htmlspecialchars($_SESSION['pseudo']);
              echo $pseudo;
            } else {
              echo "void";
            }
          ?>
        </div>

      </div>

      <div class="content__header__title__profil__buttons">
        <a href="profilRouteur.php?profil=profil">
          <div class="content__header__title__profil__button">
            Voir mon profil
          </div>
        </a>

        <a href="index.php?info_login=disconnect">
          <div class="content__header__title__profil__button">
            Déconnexion
          </div>
        </a>
      </div>
    </div>

  </div>

  <nav class="content__header__nav">
    <ul>
      <li><a href="raceRouteur.php?race=index">Accueil</a></li>
      <div class="content__header__nav__separation"></div>
      <li><a href="raceRouteur.php?race=sprint">Sprint</a></li>
      <div class="content__header__nav__separation"></div>
      <li><a href="raceRouteur.php?race=marathon">Le Marathon</a></li>
      <div class="content__header__nav__separation"></div>
      <li><a href="raceRouteur.php?time=index">Temps</a></li>
    </ul>
  </nav>

</section>
