/* Ce script doit préparer un mélange de tous les couples de
multiplications et les proposer dans le désordre.
On doit chronométrer.
On doit voir la progression. 
 */

//############## DECLARATION DES VARIABLES #######
import { Chrono } from "./chrono.js";
import { couplerTous, melanger } from "./fonctions.js";

let i = 0;
let nb1 = null;
let nb2 = null;

// Définir les listes des aMultiplier et multiplicateur
const aMultiplier = [2, 3, 4, 5, 6, 7, 8, 9];
const multiplicateur = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// Récupérer les éléments à modifier
const chiffre1 = document.getElementById("chiffre1");
const chiffre2 = document.getElementById("chiffre2");
const chiffre3 = document.getElementById("chiffre3");
const avis = document.getElementById("avis");

// Variables pour le chrono
let clickCount = 1;
const myChrono = new Chrono("temps");
const btnChrono = document.getElementById("bouton_chrono");
const reload = document.getElementById("reload");
const temps = document.getElementById("temps").innerText;

// Préparer les données
const couplesMultiplications = couplerTous(aMultiplier, multiplicateur);
const couplesMelanges = melanger(couplesMultiplications);

// Charger les premières valeurs
chiffre1.textContent = "-";
chiffre2.textContent = "-";

// Variable de session
const pseudo = document.getElementById("nom_coureur").innerText;
const visiteur = "visiteuse ou visiteur";

// La licorne
let licorne = document.createElement("img");
licorne.src = "images/licorne-detouree.png";
document.getElementById("depart_arrivee").appendChild(licorne);

// ################### GESTION MULTIPLICATION ###########

chiffre3.addEventListener("change", (event) => {
  // On vérifie si le chrono est lancé
  if (clickCount % 2 == 0) {
    // Récupérer les valeurs
    let nb3 = document.getElementById("chiffre3").value;
    let result = nb1 * nb2;

    // Vérification réponse et on est pas à la fin
    if (result == nb3 && i <= couplesMelanges.length - 1) {
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
      elmtModifie.appendChild(licorne);

      i++;
    } else {
      // soit c'est la fin soit c'est pas la bonne réponse
      if (result == nb3 && i == couplesMelanges.length) {
        myChrono.stopChrono();
        clickCount++;
        chiffre1.textContent = "-";
        chiffre2.textContent = "-";
        chiffre3.value = "";

        // On positionne la licorne dans le bloc arrivée
        document.getElementById("depart_arrivee").appendChild(licorne);

        // on colore le dernier bloc (en attendant mieux)
        document.getElementById("bloc80").style.backgroundColor = "#3f3fe1";

        // On créé le bouton pour enregistrer le temps
        let btnEnregistrer = document.createElement("div");
        btnEnregistrer.setAttribute("id", "enregistrer");
        btnEnregistrer.innerText = "Enregistrer";
        document.getElementById("chrono").appendChild(btnEnregistrer);

        // On ajoute l'envoi à la page bdd si c'est pas un visiteur
        if (pseudo == visiteur) {
          avis.innerHTML =
            "C'EST L'ARRIVEE !!!' !<br />Choisis un pseudo pour enregistrer ton temps !";
        } else {
          const enregistrer = document.getElementById("enregistrer");
          enregistrer.addEventListener("click", (event) => {
            document.location.href =
              "./enregistrer_temps.php?temps=" +
              document.getElementById("temps").innerText +
              "&table_multiplication=toutes" +
              "&melange=melangées";
          });
          avis.innerHTML = "C'EST L'ARRIVEE !!!' !<br />Enregistre ton temps !";
        }
      } else {
        avis.innerText = "Oups ! ce n'est pas la bonne réponse...";
      }
    }
  } else {
    avis.innerText = "Il faut lancer le chrono";
  }
});

//#################### GESTION DU CHRONO #################

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

reload.addEventListener("click", (event) => {
  document.location.reload(true);
});
