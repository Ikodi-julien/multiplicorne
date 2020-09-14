//############# DECLARATION DES VARIABLES ############
import {
  coupler,
  couplerTous,
  melanger,
  play,
} from "./fonctions.js";
import {
  Chrono
} from "./chrono.js";

//Variables chrono
let clickCount = 0;
const myChrono = new Chrono("time");
const btnChrono = document.getElementById("btnGo");
const reload = document.getElementById("btnReload");

// Variables multiplication
const aMultiplier = [2, 3, 4, 5, 6, 7, 8, 9];
const multiplicateur = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let couplesMultiplications = [];
let couplesMelanges = [];
let i = 0;
let nb1 = null;
let nb2 = null;
let table = "";
let melange = "";

// Récupérer les éléments à modifier
const chiffre1 = document.getElementById("chiffre1");
const chiffre2 = document.getElementById("chiffre2");
const chiffre3 = document.getElementById("chiffre3");
const comment = document.getElementById("comment");

// Variable de session
const pseudo = document.getElementById("pseudo").innerText;
const visiteur = "visiteuse ou visiteur";
const pageUrl = document.location.href;
const page = pageUrl.substring(pageUrl.length - 6);
let location = "";

// La licorne
let licorne = document.createElement("img");
licorne.src = "./images/licorne-detouree.png";
licorne.style.position = "relative";
licorne.style.bottom = "20px";


// Ajustement des constante selon la page
if (page == "sprint") {
  const location = "./raceViews/sprintView.php";
  document.getElementById("bloc0").appendChild(licorne);
  comment.innerText =
    'Choisis une table, mélangée ou non et clique sur "GO" pour démarrer le chrono';

} else if (page == "rathon") {
  location = "./raceViews/marathonView.php";
  table = "Toutes ";
  melange = "mélangées";
  document.getElementById("start_finish").appendChild(licorne);

  // Préparer les données
  couplesMultiplications = couplerTous(aMultiplier, multiplicateur);
  couplesMelanges = melanger(couplesMultiplications);

  // Charger les premières valeurs
  chiffre1.textContent = "-";
  chiffre2.textContent = "-";

} else {
  comment.innerText = "Page pas reconnue";

}

//################ Boucle principale ####################

btnChrono.addEventListener("click", (event) => {
  // OK si course au début et table choisie
  if (page == "sprint") {
    const table = document.getElementById("tables").value;

    if (table == "-") {
      comment.innerText = "Il faut choisir une table !!";
      return;

    } else {
      // Préparer les données
      let sontCouples = coupler(table, multiplicateur);

      // Mélanger si demandé
      melange = document.querySelector('input[name="melange"]:checked')
        .value;

      if (melange == "mélangée") {
        couplesMelanges = melanger(sontCouples);
      } else {
        couplesMelanges = sontCouples;
      }
    }
  }

  // Démarrage du chrono si pas de multiplication déjà faites
  if (i == 0 && clickCount == 0) {

    clickCount++;
    // Démarrer le chrono
    myChrono.stopChrono();
    myChrono.debut = +new Date();
    myChrono.startChrono();
    [nb1, nb2] = couplesMelanges[0];
    i++;
    chiffre1.textContent = nb1;
    chiffre2.textContent = nb2;
    comment.textContent = "C'EST PARTI !!!";

    // Modifier les éléments si réponse modifiée
    chiffre3.addEventListener("change", (event) => {

      if (page == "sprint") {
        document.getElementById("bloc0").style.backgroundColor = "#3f3fe1";
      }

      // Récupérer les valeurs
      let nb3 = document.getElementById("chiffre3").value;
      let result = nb1 * nb2;

      // Vérification réponse et on est pas à la fin
      if (result == nb3 && i < couplesMelanges.length) {
        comment.innerText = i;
        [nb1, nb2] = couplesMelanges[i];
        chiffre1.textContent = nb1;
        chiffre2.textContent = nb2;
        chiffre3.value = "";

        // variable de choix des éléments de la course à modifier
        const blocModifie = "bloc" + i;

        // On récupère l'élément à modifier, on le colore et on ajoute la licorne
        const elmtModifie = document.getElementById(blocModifie);
        elmtModifie.style.backgroundColor = "#3f3fe1";

        // Prévoir positionnement différent selon page
        if (page == "sprint") {
          elmtModifie.appendChild(licorne);
        } else if (page == "rathon") {
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
        }
        i++;
      } else {
        // soit c'est la fin soit c'est pas la bonne réponse
        if (result == nb3 && i == couplesMelanges.length) {

          if (page == "rathon") {
            clickCount++;
            // On finit les modifications de couleur
            document.getElementById("bloc80").style.backgroundColor = "#3f3fe1";

            // On positionne la licorne dans le bloc arrivée
            document.getElementById("start_finish").appendChild(licorne);

          } else if (page == "sprint") {

            // On finit les modifications de couleur
            document.getElementById("bloc_fin").style.backgroundColor =
              "#3f3fe1";

            // On positionne la licorne dans le dernier
            document.getElementById("bloc_fin").appendChild(licorne);
          }
          myChrono.stopChrono();
          chiffre1.textContent = "-";
          chiffre2.textContent = "-";
          chiffre3.value = "";


          // On créé les boutons pour enregistrer le temps ou quitter
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
          const winnerTime = document.getElementById("winnerTime");
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
    });
  } else {
    document.location.reload();
  }
});

reload.addEventListener("click", (event) => {
  document.location.reload();
});