<div id="winner" class="winner">
  <div id="winnerBox" class="winner__box">
    <div class="winner__box__logo">
      <img src=<?php
        if (isset($_SESSION['avatar'])) {
          echo "./public/images/". htmlspecialchars($_SESSION['avatar']) .".png";
        } else {
          echo "./public/images/licorne.png";
        }
      ?> alt="licorne... sisi !" />
    </div>
    <h1 id="winnerMsg" class="winner__box__msg">Félicitation, C'est Gagné !</h1>
    <h3 class="winner__box__time">Ton temps : <span id="winnerTime"></span></h3>
    <div id="winnerBtn" class="winner__box__button"></div>
      <span id="timeForDB"></span>
  </div>
</div>