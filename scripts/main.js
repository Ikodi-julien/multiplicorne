//############# DECLARATION DES VARIABLES ############
import {
  utils
} from "./utils.js";
import {
  Chrono
} from "./Chrono.js";

//Variables chrono
let clickCount = 0;
const myChrono = new Chrono("time");
const btnChrono = document.getElementById("btnGo");
const reload = document.getElementById("btnReload");

// Variables opérations
let i = 0;
let sign, nb1, nb2, result, mixCheck;

// Récupérer les éléments à modifier
const chiffre1 = document.getElementById("chiffre1");
const chiffre2 = document.getElementById("chiffre2");
const opSignElt = document.getElementById("opSign");
const chiffre3 = document.getElementById("chiffre3");
const comment = document.getElementById("comment");

// Variable de session
const pseudo = document.getElementById("pseudo").innerText;
const visiteur = "visiteur.euse";
const urlParams = new URLSearchParams(window.location.search);

const raceType = urlParams.get('race');
const operationType = urlParams.get('op');

// console.log('raceType : ' + raceType)
// console.log('operationType : ' + operationType)

// L'avatar
const avatarName = document.getElementById("avatarName").innerText;
let avatar = document.createElement("img");
avatar.src = "./images/" + avatarName + ".png";
avatar.style.position = "relative";
avatar.style.bottom = "20px";


// Ajustement de l'affichage selon la page
const pageDetails = utils.prepareView(raceType, operationType);

document.getElementById(pageDetails.startElt).appendChild(avatar);
opSignElt.textContent = pageDetails.sign;
comment.innerText = pageDetails.comment;


//################ Boucle principale ####################

btnChrono.addEventListener("click", (event) => {


  /* --- Préparation de l'affichage selon la course --- */

  // Objet de paramétrage commun aux différentes courses
  const raceDetails = {
    table: '',
    operations: '',
    mix: ''
  }

  if (raceType === "sprint") {

    if (operationType == "multipli") {

      raceDetails.table = document.getElementById("tables").value;

      // OK si course au début et table choisie
      if (raceDetails.table == "-") {
        comment.innerText = "Il faut choisir une table !!";
        return;

      } else {
        // Préparer les multiplications d'une table
        raceDetails.operations = utils.makeCouples(raceDetails.table);

        // Mélanger si demandé
        mixCheck = document.querySelector('input[name="melange"]:checked')
          .value;

        if (mixCheck == "mélangée") {
          raceDetails.operations = utils.mix(raceDetails.operations);
          raceDetails.mix = 'mélangée'
        } else {
          raceDetails.mix = 'dans l\'ordre'
        }
      }
    } else if (operationType == "add") {
      raceDetails.operations = utils.createOperations(10, '+');

    } else if (operationType == "sub") {
      raceDetails.operations = utils.createOperations(10, '-');
    }
  } else if (raceType === "marathon") {

    if (operationType === "multipli") {
      raceDetails.operations = utils.mix(utils.coupleAll());

    } else if (operationType === "add_sub") {
      raceDetails.operations = utils.mix(utils.createOperations(40, "+").concat(utils.createOperations(40, "-")));

    }
  } else {
    return
  }
  /* --- Démarrage du chrono si pas de multiplication déjà faites --- */

  if (i == 0 && clickCount == 0) {

    clickCount++;
    // Démarrer le chrono
    myChrono.stopChrono();
    myChrono.debut = +new Date();
    myChrono.startChrono();

    // Placer la première opération
    [sign, nb1, nb2] = raceDetails.operations[0];
    i++;
    chiffre1.textContent = nb1;
    chiffre2.textContent = nb2;
    opSignElt.textContent = sign;
    comment.textContent = "C'EST PARTI !!!";

    /* --- LISTENER DE L'INPUT ---*/
    chiffre3.addEventListener("change", (event) => {

      if (raceType === "sprint") {
        document.getElementById(pageDetails.startElt).style.backgroundColor = "#3f3fe1";
      }

      // Récupérer les valeurs
      const nb3 = document.getElementById("chiffre3").value;

      // Gérer le résultat attendu en fonction du type d'opération

      switch (sign) {
        case "+":
          result = nb1 + nb2;
          break;
        case "-":
          result = nb1 - nb2;
          break;
        case "x":
          result = nb1 * nb2;
          break;

        default:
          break;
      }

      // Vérification réponse et on est pas à la fin
      if (result == nb3 && i < raceDetails.operations.length) {
        // if (result == nb3 && i < 2) {
        comment.innerText = "Oui, c'est la bonne réponse !";
        [sign, nb1, nb2] = raceDetails.operations[i];
        chiffre1.textContent = nb1;
        opSignElt.textContent = sign;
        chiffre2.textContent = nb2;
        chiffre3.value = "";

        // variable de choix des éléments de la course à modifier
        const blocModifie = "bloc" + i;

        // On récupère l'élément à modifier, on le colore et on ajoute l'avatar
        const elmtModifie = document.getElementById(blocModifie);
        elmtModifie.style.backgroundColor = "#3f3fe1";

        // Prévoir positionnement différent selon page
        if (raceType === "sprint") {
          elmtModifie.appendChild(avatar);

        } else if (raceType === "marathon") {
          if (i >= 74 | i < 10) {
            avatar.src = "./images/" + avatarName + ".png";
            avatar.style.removeProperty("right");
            avatar.style.bottom = "20px";
            elmtModifie.appendChild(avatar);
          } else if (i >= 10 && i < 30) {
            avatar.src = "./images/" + avatarName + "-monte.png";
            avatar.style.removeProperty("bottom");
            avatar.style.left = "20px";
            elmtModifie.appendChild(avatar);
          } else if (i >= 30 && i < 54) {
            avatar.src = "./images/" + avatarName + "-en-haut.png";
            avatar.style.removeProperty("left");
            avatar.style.bottom = "20px";
            elmtModifie.appendChild(avatar);
          } else if (i >= 54 && i < 74) {
            avatar.src = "./images/" + avatarName + "-descend.png";
            avatar.style.removeProperty("bottom");
            avatar.style.left = "20px";
            elmtModifie.appendChild(avatar);
          }
        }
        i++;
      } else {
        // soit c'est la fin soit c'est pas la bonne réponse
        if (result == nb3 && i == raceDetails.operations.length) {
          // if (result == nb3 && i == 2) {

          if (raceType === "marathon") {
            clickCount++;
            // On finit les modifications de couleur
            document.getElementById("bloc80").style.backgroundColor = "#3f3fe1";

            // On positionne l'avatar dans le bloc arrivée
            document.getElementById("start_finish").appendChild(avatar);

          } else if (raceType === "marathon") {

            // On finit les modifications de couleur
            document.getElementById("bloc_fin").style.backgroundColor =
              "#3f3fe1";

            // On positionne l'avatar dans le dernier
            document.getElementById("bloc_fin").appendChild(avatar);
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
          utils.play(winner, "anim_gagnant");

          // on affiche le temps dans le message au gagnant
          const winnerTime = document.getElementById("winnerTime");
          winnerTime.innerText = myChrono.tempsAffiche;

          // Listener pour enregistrer le temps
          const enregistrer = document.getElementById("enregistrer");
          enregistrer.addEventListener("click", (event) => {
            document.location.href =
              "./raceRouteur.php?time=record" +
              "&duration=" + myChrono.totalDuration +
              "&race_type=" + raceType +
              "&operation_type=" + operationType +
              "&table=" + raceDetails.table +
              "&mixed=" + raceDetails.mix
          });
          console.log(document.location.href);

          // On différençie si visiteur ou non
          if (pseudo === visiteur) {

            const btnIndex = document.createElement("button");
            btnIndex.setAttribute("id", "index");
            btnIndex.innerText = "Créer un compte";
            document.getElementById("winnerBtn").appendChild(btnIndex);
            btnIndex.addEventListener("click", (event) => {
              document.location.href = "./index.php";
            });

            document.getElementById("winnerMsg").innerHTML =
              "Félicitation, c'est gagné !<br>Crée un compte et choisis un pseudo pour pouvoir retrouver tes temps.";
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
