// Ce script doit permettre de résoudre la table de son choix = ok,
// on doit avoir la possibilité de mélanger ou non la table = nok,
// On doit pouvoir chronométrer = ok,
// On doit voir la progression = nok,

//############# DECLARATION DES VARIABLES ############
import { coupler, melanger } from "./fonctions.js";
import { Chrono } from "./chrono.js";

//Variables chrono
let clickCount = 0;
const myChrono = new Chrono("temps");
const btnChrono = document.getElementById("bouton_chrono");
const reload = document.getElementById("reload");

// Variables multiplication
const multiplicateur = [2, 3, 4, 5, 6, 7, 8, 9, 10];

const chiffre1 = document.getElementById("chiffre1");
const chiffre2 = document.getElementById("chiffre2");
const chiffre3 = document.getElementById("chiffre3");
const avis = document.getElementById("avis");

let couplesMultiplications = [];
let i = 0;
let nb1 = null;
let nb2 = null;

// Variable de session
const pseudo = document.getElementById("nom_coureur").innerText;
const visiteur = "visiteuse ou visiteur";

// La licorne
let licorne = document.createElement("img");
licorne.src = "images/licorne-detouree.png";
document.getElementById("bloc0").appendChild(licorne);

// Affichage consigne
avis.innerText =
  'Choisis une table, mélangée ou non et clique sur "GO" pour démarrer le chrono';
//################ Boucle principale ####################

btnChrono.addEventListener("click", (event) => {
  // OK si course au début et table choisie
  const table = document.getElementById("tables").value;
  if (table != "-") {
    // Préparer les données
    let sontCouples = coupler(table, multiplicateur);

    // Mélanger si demandé
    const melange = document.querySelector('input[name="melange"]:checked')
      .value;
    if (melange == "mélangée") {
      couplesMultiplications = melanger(sontCouples);
    } else {
      couplesMultiplications = sontCouples;
    }

    if (i == 0 && clickCount < 1) {
      clickCount++;
      // Démarrer le chrono
      myChrono.stopChrono();
      myChrono.debut = +new Date();
      myChrono.startChrono();
      [nb1, nb2] = couplesMultiplications[0];
      i++;
      chiffre1.textContent = nb1;
      chiffre2.textContent = nb2;
      avis.textContent = "C'EST PARTI !!!";

      // Modifier les éléments si réponse modifiée
      chiffre3.addEventListener("change", (event) => {
        document.getElementById("bloc0").style.backgroundColor = "#3f3fe1";
        // Récupérer les valeurs
        let nb3 = document.getElementById("chiffre3").value;
        let result = nb1 * nb2;

        // Vérification réponse et on est pas à la fin
        if (result == nb3 && i < couplesMultiplications.length) {
          avis.innerText = "oui, c'est bon...";
          [nb1, nb2] = couplesMultiplications[i];
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
          if (result == nb3 && i == couplesMultiplications.length) {
            avis.innerText = "BRAVO ! C'EST L'ARRIVEE !!!!!!";
            myChrono.stopChrono();
            chiffre1.textContent = "-";
            chiffre2.textContent = "-";
            chiffre3.value = "";

            // On finit les modifications de couleur
            document.getElementById("bloc_fin").style.backgroundColor =
              "#3f3fe1";

            // On positionne la licorne dans le dernier
            document.getElementById("bloc_fin").appendChild(licorne);

            // On créé le bouton pour enregistrer le temps
            let btnEnregistrer = document.createElement("div");
            btnEnregistrer.setAttribute("id", "enregistrer");
            btnEnregistrer.innerText = "Enregistrer";
            document.getElementById("chrono").appendChild(btnEnregistrer);

            // On ajoute l'envoi à la page bdd si c'est pas un visiteur
            if (pseudo != visiteur) {
              const enregistrer = document.getElementById("enregistrer");
              enregistrer.addEventListener("click", (event) => {
                document.location.href =
                  "./enregistrer_temps.php?temps=" +
                  document.getElementById("temps").innerText +
                  "&table_multiplication=" +
                  table +
                  "&melange=" +
                  melange +
                  "&page=page_table_unique.php";
              });
              avis.innerHTML =
                "C'EST L'ARRIVEE !!!' !<br />Enregistre ton temps !";
            } else {
              avis.innerHTML =
                "C'EST L'ARRIVEE !!!' !<br />Choisis un pseudo pour enregistrer ton temps !";
            }
          } else {
            avis.innerText = "Oups ! ce n'est pas la bonne réponse...";
          }
        }
      });
    } else {
      document.location.reload(false);
    }
  } else {
    avis.innerText = "Il faut choisir une table !!";
  }
});

reload.addEventListener("click", (event) => {
  document.location.reload(true);
});
