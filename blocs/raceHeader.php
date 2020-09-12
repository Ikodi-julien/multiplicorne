<section class="race__header">
  <div class="race__header__profil">

    <div id="pseudo" class="race__header__profil__pseudo">

      <?php if (isset($_SESSION['pseudo'])) {
          $pseudo = htmlspecialchars($_SESSION['pseudo']);
          echo $pseudo;
        } else {
          echo "void";
        }
      ?>
    </div>

    <a href="index.php">
    <div class="race__header__profil__change">
      Changer
    </div>
    </a>
  </div>

  <div class="race__header__title">
    <h1>Les multiplications, ça fait avancer les Licornes !</h1>
  </div>

  <nav class="race__header__nav">
    <ul>
      <li><a href="index.php?race=index">Accueil</a></li>
      <div class="race__header__nav__separation"></div>
      <li><a href="index.php?race=sprint">Sprint</a></li>
      <div class="race__header__nav__separation"></div>
      <li><a href="index.php?race=marathon">Le Marathon</a></li>
      <div class="race__header__nav__separation"></div>
      <li><a href="index.php?time=index">Temps</a></li>
    </ul>
  </nav>

</section>
