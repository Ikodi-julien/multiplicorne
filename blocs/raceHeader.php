<section class="content__header">

  <div class="content__header__title">
    <h1>Les multiplications, ça fait avancer les Licornes !</h1>

    <div class="content__header__profil">

      
      <a href="
      <?php
      if ($_SESSION['pseudo'] !== 'visiteur.euse') {
        echo 'profilRouteur.php?profil=profil';
      } else {
        echo '#';
      }
      ?>
      ">
        <div class="content__header__profil__avatars">

          <div class="photo">
            <div class="photo__profil">
              <img src="./avatars/mini_<?php
              $photoProfil = "./avatars/mini_". $pseudo . ".png";
              if (file_exists($photoProfil)) {
                echo $pseudo;
              } else {
                echo "default";
              }?>.png" alt="Image Profil">
                
            </div>

            <div class="photo__avatar">
              <img src="./images/<?php echo $_SESSION['avatar'];?>.png" alt="Image Avatar">
            </div>
          </div>

          <div class="content__header__profil__names">
            <div class="content__header__profil__names__name" id="pseudo">
              <?php if (isset($_SESSION['pseudo'])) {
                  $pseudo = htmlspecialchars($_SESSION['pseudo']);
                  echo $pseudo;
                } else {
                  echo "void";
                }
              ?>
            </div>

            <div class="content__header__profil__names__name" id="avatarName">
              <?php if (isset($_SESSION['avatar'])) {
                  $avatar = htmlspecialchars($_SESSION['avatar']);
                  echo $avatar;
                } else {
                  echo "licorne";
                }
              ?>
            </div>
          </div>
        </div>
      </a>

      <?php
      if ($_SESSION['pseudo'] === 'visiteur.euse') {
      ?>
      
      <div class="content__header__profil__buttons">
        <a href="index.php?info_login=connect">
          <button>
            Connexion
          </button>
        </a>
      </div>
      
      <?php 
      } else {
        ?>
      
      <div class="content__header__profil__buttons">
        <a href="profilRouteur.php?profil=profil">
          <button>
            Mes paramètres
          </button>
        </a>

        <a href="index.php?info_login=disconnect">
          <button>
            Déconnexion
          </button>
        </a>
      </div>
      
      <?php
      }
      ?>
    </div>

  </div>

  <nav class="content__header__nav">
    <ul>
      <li><a href="raceRouteur.php?race=index">Accueil</a></li>
      <div class="content__header__nav__separation"></div>
      <li>
        
        <select name="selectRaces" class="content__header__nav__select" id="selectRaces">
          <option value="">Courses</option>
          <option value="addition">Additions</option>
          <option value="soustraction">Soustractions</option>
          <option value="multiplication">Multiplications</option>
          <option value="marathonAddSub">Marathon additions - soustractions</option>
          <option value="marathonMulti">Marathon multiplications</option>
        </select>
      
      
      </li>

      <div class="content__header__nav__separation"></div>
      <li><a href="raceRouteur.php?time=index">Temps</a></li>
    </ul>
  </nav>

</section>