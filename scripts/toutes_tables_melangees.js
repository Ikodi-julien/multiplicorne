/* Ce script doit préparer un mélange de tous les couples de
multiplications et les proposer dans le désordre.
On doit chronométrer.
On doit voir la progression. 
 */

//############## DECLARATION DES VARIABLES #######
import {
  couplerTous,
  melanger,
  play
} from "./fonctions.js";
import {
  Chrono
} from "./chrono.js";

// Variables pour le chrono
let clickCount = 1;
const myChrono = new Chrono("time");
const btnChrono = document.getElementById("btnGo");
const reload = document.getElementById("btnReload");


// Variables multiplication
const aMultiplier = [2, 3, 4, 5, 6, 7, 8, 9];
const multiplicateur = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let i = 0;
let nb1 = null;
let nb2 = null;
const table = "Toutes ";
const melange = "mélangées";

// Récupérer les éléments à modifier
const chiffre1 = document.getElementById("chiffre1");
const chiffre2 = document.getElementById("chiffre2");
const chiffre3 = document.getElementById("chiffre3");
const comment = document.getElementById("comment");

// Variable de session
const pseudo = document.getElementById("pseudo").innerText;
const visiteur = "visiteuse ou visiteur";
const location = "./raceViews/marathonView.php";

// La licorne
let licorne = document.createElement("img");
licorne.src = "images/licorne-detouree.png";
licorne.style.position = "relative";
licorne.style.bottom = "20px";

document.getElementById("start_finish").appendChild(licorne);

// Préparer les données
const couplesMultiplications = couplerTous(aMultiplier, multiplicateur);
const couplesMelanges = melanger(couplesMultiplications);

// Charger les premières valeurs
chiffre1.textContent = "-";
chiffre2.textContent = "-";

//#################### CHRONO #################

btnChrono.addEventListener("click", (event) => {
  clickCount++;
  // OK si course remise à 0
  if (i === 0) {
    if (clickCount % 2 == 0) {
      myChrono.debut = +new Date();
      myChrono.startChrono();
      [nb1, nb2] = couplesMelanges[0];
      chiffre1.textContent = nb1;
      chiffre2.textContent = nb2;
      comment.textContent = "C'est parti !";
      i++;
      return (clickCount = 2);
    } else {
      myChrono.stopChrono();
    }
  } else {
    comment.textContent = 'Clique sur "Refaire une course"';
  }
});

// ################### GESTION MULTIPLICATION ###########

chiffre3.addEventListener("change", (event) => {
  // On vérifie si le chrono est lancé
  if (clickCount % 2 == 0) {
    // Récupérer les valeurs
    let nb3 = document.getElementById("chiffre3").value;
    let result = nb1 * nb2;

    // Vérification réponse et on est pas à la fin
    if (result == nb3 && i <= couplesMelanges.length - 1) {
      comment.innerText = "oui, c'est bon...";
      [nb1, nb2] = couplesMelanges[i];
      chiffre1.textContent = nb1;
      chiffre2.textContent = nb2;
      chiffre3.value = "";

      // variable de choix des éléments de la course à modifier
      const blocModifie = "bloc" + i;

      // On récupère l'élément à modifier, on le colore et on ajoute la licorne
      const elmtModifie = document.getElementById(blocModifie);
      elmtModifie.style.backgroundColor = "#3f3fe1";

      // Rotation de la licorne
      if (i >= 74 | i < 10) {
        licorne.src = "./images/licorne-detouree.png";
        licorne.style.removeProperty("right");
        licorne.style.bottom = "20px";
        elmtModifie.appendChild(licorne);
      } else if (i >= 10 && i < 30) {
        licorne.src = "./images/licorne-monte.png";
        licorne.style.removeProperty("bottom");
        licorne.style.left = "20px";
        elmtModifie.appendChild(licorne);
      } else if (i >= 30 && i < 54) {
        licorne.src = "./images/licorne-en-haut.png";
        licorne.style.removeProperty("left");
        licorne.style.bottom = "20px";
        elmtModifie.appendChild(licorne);
      } else if (i >= 54 && i < 74) {
        licorne.src = "./images/licorne-descend.png";
        licorne.style.removeProperty("bottom");
        licorne.style.left = "20px";
        elmtModifie.appendChild(licorne);
      }

      i++;
    } else {
      // soit c'est la fin soit c'est pas la bonne réponse
      if (result == nb3 && i == couplesMelanges.length) {

        clickCount++;

        myChrono.stopChrono();
        chiffre1.textContent = "-";
        chiffre2.textContent = "-";
        chiffre3.value = "";

        // On finit les modifications de couleur
        document.getElementById("bloc80").style.backgroundColor = "#3f3fe1";

        // On positionne la licorne dans le bloc arrivée
        document.getElementById("start_finish").appendChild(licorne);

        // On créé les bouton pour enregistrer le temps et quitter
        let btnEnregistrer = document.createElement("button");
        btnEnregistrer.setAttribute("id", "enregistrer");
        btnEnregistrer.innerText = "Enregistrer";
        document
          .getElementById("winnerBtn")
          .appendChild(btnEnregistrer);

        let btnQuitter = document.createElement("button");
        btnQuitter.setAttribute("id", "quitter");
        btnQuitter.innerText = "Retour";
        document.getElementById("winnerBtn").appendChild(btnQuitter);
        btnQuitter.addEventListener("click", (event) => {
          document.location.reload();
        });

        // On envoi le message pour le gagnant
        const winner = document.getElementById("winner");
        play(winner, "anim_gagnant");

        // on affiche le temps dans le message au gagnant
        winnerTime = document.getElementById("winnerTime");
        winnerTime.innerText = myChrono.tempsAffiche;

        // On différençie si visiteur ou non
        if (pseudo != visiteur) {
          const enregistrer = document.getElementById("enregistrer");
          enregistrer.addEventListener("click", (event) => {
            document.location.href =
              "./index.php?time=record&duration=" +
              document.getElementById("time").innerText +
              "&table=" +
              table +
              "&mixed=" +
              melange +
              "&location=" +
              location;
          });
        } else {
          document.getElementById("winnerBtn").removeChild(btnEnregistrer);

          const btnIndex = document.createElement("button");
          btnIndex.setAttribute("id", "index");
          btnIndex.innerText = "Choisir un pseudo";
          document.getElementById("winnerBtn").appendChild(btnIndex);
          btnIndex.addEventListener("click", (event) => {
            document.location.href = "./index.php";
          });

          document.getElementById("winnerMsg").innerHTML =
            "<p style='font-size: 18px'>Félicitation, c'est gagné !<br>Choisis un pseudo pour pouvoir enregistrer ton temps.</p>";
        }
      } else {
        comment.innerText = "Oups ! ce n'est pas la bonne réponse...";
      }
    }
  } else {
    comment.innerText = "Il faut lancer le chrono";
  }
});

reload.addEventListener("click", (event) => {
  document.location.reload();
});