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
const myChrono = new Chrono("temps");
const btnChrono = document.getElementById("bouton_chrono");
const reload = document.getElementById("reload");
const temps = document.getElementById("temps").innerText;


// Variables multiplication
const aMultiplier = [2, 3, 4, 5, 6, 7, 8, 9];
const multiplicateur = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let i = 0;
let nb1 = null;
let nb2 = null;

// Récupérer les éléments à modifier
const chiffre1 = document.getElementById("chiffre1");
const chiffre2 = document.getElementById("chiffre2");
const chiffre3 = document.getElementById("chiffre3");
const avis = document.getElementById("avis");

// Variable de session
const pseudo = document.getElementById("nom_coureur").innerText;
const visiteur = "visiteuse ou visiteur";

// Préparer les données
const couplesMultiplications = couplerTous(aMultiplier, multiplicateur);
const couplesMelanges = melanger(couplesMultiplications);

// Charger les premières valeurs
chiffre1.textContent = "-";
chiffre2.textContent = "-";

// La licorne
let licorne = document.createElement("img");
licorne.src = "images/licorne-detouree.png";
document.getElementById("depart_arrivee").appendChild(licorne);

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
      avis.textContent = "C'est parti !";
      i++;
      return (clickCount = 2);
    } else {
      myChrono.stopChrono();
    }
  } else {
    avis.textContent = 'Clique sur "Refaire une course"';
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
    if (result == nb3 && i <= couplesMelanges.length - 76) {
      avis.innerText = "oui, c'est bon...";
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
      if (i > 70 | i < 11) {
        licorne.src = "./images/licorne-detouree.png";
        elmtModifie.appendChild(licorne);
      } else if (i > 10 && i < 26) {
        licorne.src = "./images/licorne-monte.png";
        elmtModifie.appendChild(licorne);
      } else if (i > 25 && i < 56) {
        licorne.src = "./images/licorne-en-haut.png";
        elmtModifie.appendChild(licorne);
      } else if (i > 55 && i < 71) {
        licorne.src = "./images/licorne-descend.png";
        elmtModifie.appendChild(licorne);
      }

      i++;
    } else {
      // soit c'est la fin soit c'est pas la bonne réponse
      if (result == nb3 && i == couplesMelanges.length - 75) {

        clickCount++;

        myChrono.stopChrono();
        chiffre1.textContent = "-";
        chiffre2.textContent = "-";
        chiffre3.value = "";

        // On finit les modifications de couleur
        document.getElementById("bloc80").style.backgroundColor = "#3f3fe1";

        // On positionne la licorne dans le bloc arrivée
        document.getElementById("depart_arrivee").appendChild(licorne);

        // On créé les bouton pour enregistrer le temps et quitter
        let btnEnregistrer = document.createElement("div");
        btnEnregistrer.setAttribute("id", "enregistrer");
        btnEnregistrer.innerText = "Enregistrer";
        document
          .getElementById("winner_button")
          .appendChild(btnEnregistrer);

        let btnQuitter = document.createElement("div");
        btnQuitter.setAttribute("id", "quitter");
        btnQuitter.innerText = "Retour";
        document.getElementById("winner_button").appendChild(btnQuitter);
        btnQuitter.addEventListener("click", (event) => {
          document.location.reload(true);
        });

        // On envoi le message pour le gagnant
        let fondGagnant = document.getElementById("fond_gagnant");
        let cadreGagnant = document.getElementById("cadre_gagnant");
        play(fondGagnant, "anim_gagnant");
        play(cadreGagnant, "anim_gagnant");

        // on affiche le temps dans le message au gagnant
        let affichageTemps = document.getElementById("affichage_temps");
        affichageTemps.innerText = myChrono.tempsAffiche;

        // On différençie si visiteur ou non pour enregistrer le temps
        const enregistrer = document.getElementById("enregistrer");
        enregistrer.addEventListener("click", (event) => {
          if (pseudo != visiteur) {
            document.location.href =
              "./enregistrer_temps.php?temps=" +
              document.getElementById("temps").innerText +
              "&table_multiplication=" +
              table +
              "&melange=" +
              melange +
              "&page=page_table_unique.php";
          } else {
            document.getElementById("winner_button").removeChild(btnEnregistrer);

            let btnIndex = document.createElement("a");
            btnIndex.setAttribute("id", "index");
            btnIndex.setAttribute("href", "index.php");
            btnIndex.innerText = "Choisir un pseudo";
            document.getElementById("winner_button").appendChild(btnIndex);

            let winnerTime = document.getElementById("winner_time");
            document.getElementById("cadre_gagnant").removeChild(winnerTime);
            document.getElementById("winner_msg").innerHTML =
              "Choisis un pseudo pour pouvoir enregistrer ton temps.";

          }
        });
      } else {
        avis.innerText = "Oups ! ce n'est pas la bonne réponse...";
      }
    }
  } else {
    avis.innerText = "Il faut lancer le chrono";
  }
});

reload.addEventListener("click", (event) => {
  document.location.reload(true);
});