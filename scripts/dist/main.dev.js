"use strict";

var _utils = require("./utils.js");

var _Chrono = require("./Chrono.js");

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

//Variables chrono
var clickCount = 0;
var myChrono = new _Chrono.Chrono("time");
var btnChrono = document.getElementById("btnGo");
var reload = document.getElementById("btnReload"); // Variables opérations

var i = 0;
var sign, nb1, nb2, result, mixCheck; // Récupérer les éléments à modifier

var chiffre1 = document.getElementById("chiffre1");
var chiffre2 = document.getElementById("chiffre2");
var opSignElt = document.getElementById("opSign");
var chiffre3 = document.getElementById("chiffre3");
var comment = document.getElementById("comment"); // Variable de session

var pseudo = document.getElementById("pseudo").innerText;
var visiteur = "visiteur.euse";
var urlParams = new URLSearchParams(window.location.search);
var raceType = urlParams.get('race');
var operationType = urlParams.get('op'); // console.log('raceType : ' + raceType)
// console.log('operationType : ' + operationType)
// L'avatar

var avatarName = document.getElementById("avatarName").innerText;
var avatar = document.createElement("img");
avatar.src = "./images/" + avatarName + ".png";
avatar.style.position = "relative";
avatar.style.bottom = "20px"; // Ajustement de l'affichage selon la page

var pageDetails = _utils.utils.prepareView(raceType, operationType);

document.getElementById(pageDetails.startElt).appendChild(avatar);
opSignElt.textContent = pageDetails.sign;
comment.innerText = pageDetails.comment; //################ Boucle principale ####################

btnChrono.addEventListener("click", function (event) {
  /* --- Préparation de l'affichage selon la course --- */
  // Objet de paramétrage commun aux différentes courses
  var raceDetails = {
    table: '',
    operations: '',
    mix: ''
  };

  if (raceType === "sprint") {
    if (operationType == "multipli") {
      raceDetails.table = document.getElementById("tables").value; // OK si course au début et table choisie

      if (raceDetails.table == "-") {
        comment.innerText = "Il faut choisir une table !!";
        return;
      } else {
        // Préparer les multiplications d'une table
        raceDetails.operations = _utils.utils.makeCouples(raceDetails.table); // Mélanger si demandé

        mixCheck = document.querySelector('input[name="melange"]:checked').value;

        if (mixCheck == "mélangée") {
          raceDetails.operations = _utils.utils.mix(raceDetails.operations);
          raceDetails.mix = 'mélangée';
        } else {
          raceDetails.mix = 'dans l\'ordre';
        }
      }
    } else if (operationType == "add") {
      raceDetails.operations = _utils.utils.createOperations(10, '+');
    } else if (operationType == "sub") {
      raceDetails.operations = _utils.utils.createOperations(10, '-');
    }
  } else if (raceType === "marathon") {
    if (operationType === "multipli") {
      raceDetails.operations = _utils.utils.mix(_utils.utils.coupleAll());
    } else if (operationType === "add_sub") {
      raceDetails.operations = _utils.utils.mix(_utils.utils.createOperations(40, "+").concat(_utils.utils.createOperations(40, "-")));
    }
  } else {
    return;
  }
  /* --- Démarrage du chrono si pas de multiplication déjà faites --- */


  if (i == 0 && clickCount == 0) {
    clickCount++; // Démarrer le chrono

    myChrono.stopChrono();
    myChrono.debut = +new Date();
    myChrono.startChrono(); // Placer la première opération

    var _raceDetails$operatio = _slicedToArray(raceDetails.operations[0], 3);

    sign = _raceDetails$operatio[0];
    nb1 = _raceDetails$operatio[1];
    nb2 = _raceDetails$operatio[2];
    i++;
    chiffre1.textContent = nb1;
    chiffre2.textContent = nb2;
    opSignElt.textContent = sign;
    comment.textContent = "C'EST PARTI !!!";
    /* --- LISTENER DE L'INPUT ---*/

    chiffre3.addEventListener("change", function (event) {
      if (raceType === "sprint") {
        document.getElementById(pageDetails.startElt).style.backgroundColor = "#3f3fe1";
      } // Récupérer les valeurs


      var nb3 = document.getElementById("chiffre3").value; // Gérer le résultat attendu en fonction du type d'opération

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
      } // Vérification réponse et on est pas à la fin


      if (result == nb3 && i < raceDetails.operations.length) {
        // if (result == nb3 && i < 2) {
        comment.innerText = "Oui, c'est la bonne réponse !";

        var _raceDetails$operatio2 = _slicedToArray(raceDetails.operations[i], 3);

        sign = _raceDetails$operatio2[0];
        nb1 = _raceDetails$operatio2[1];
        nb2 = _raceDetails$operatio2[2];
        chiffre1.textContent = nb1;
        opSignElt.textContent = sign;
        chiffre2.textContent = nb2;
        chiffre3.value = ""; // variable de choix des éléments de la course à modifier

        var blocModifie = "bloc" + i; // On récupère l'élément à modifier, on le colore et on ajoute l'avatar

        var elmtModifie = document.getElementById(blocModifie);
        elmtModifie.style.backgroundColor = "#3f3fe1"; // Prévoir positionnement différent selon page

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
            clickCount++; // On finit les modifications de couleur

            document.getElementById("bloc80").style.backgroundColor = "#3f3fe1"; // On positionne l'avatar dans le bloc arrivée

            document.getElementById("start_finish").appendChild(avatar);
          } else if (raceType === "marathon") {
            // On finit les modifications de couleur
            document.getElementById("bloc_fin").style.backgroundColor = "#3f3fe1"; // On positionne l'avatar dans le dernier

            document.getElementById("bloc_fin").appendChild(avatar);
          }

          myChrono.stopChrono();
          chiffre1.textContent = "-";
          chiffre2.textContent = "-";
          chiffre3.value = ""; // On créé les boutons pour enregistrer le temps ou quitter

          var btnEnregistrer = document.createElement("button");
          btnEnregistrer.setAttribute("id", "enregistrer");
          btnEnregistrer.innerText = "Enregistrer";
          document.getElementById("winnerBtn").appendChild(btnEnregistrer);
          var btnQuitter = document.createElement("button");
          btnQuitter.setAttribute("id", "quitter");
          btnQuitter.innerText = "Retour";
          document.getElementById("winnerBtn").appendChild(btnQuitter);
          btnQuitter.addEventListener("click", function (event) {
            document.location.reload();
          }); // On envoi le message pour le gagnant

          var winner = document.getElementById("winner");

          _utils.utils.play(winner, "anim_gagnant"); // on affiche le temps dans le message au gagnant


          var winnerTime = document.getElementById("winnerTime");
          winnerTime.innerText = myChrono.tempsAffiche; // Listener pour enregistrer le temps

          var enregistrer = document.getElementById("enregistrer");
          enregistrer.addEventListener("click", function (event) {
            document.location.href = "./raceRouteur.php?time=record" + "&duration=" + myChrono.totalDuration + "&race_type=" + raceType + "&operation_type=" + operationType + "&table=" + raceDetails.table + "&mixed=" + raceDetails.mix;
          });
          console.log(document.location.href); // On différençie si visiteur ou non

          if (pseudo === visiteur) {
            var btnIndex = document.createElement("button");
            btnIndex.setAttribute("id", "index");
            btnIndex.innerText = "Créer un compte";
            document.getElementById("winnerBtn").appendChild(btnIndex);
            btnIndex.addEventListener("click", function (event) {
              document.location.href = "./index.php";
            });
            document.getElementById("winnerMsg").innerHTML = "Félicitation, c'est gagné !<br>Crée un compte et choisis un pseudo pour pouvoir retrouver tes temps.";
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
reload.addEventListener("click", function (event) {
  document.location.reload();
});