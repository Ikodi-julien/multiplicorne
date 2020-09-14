"use strict";

var _fonctions = require("./fonctions.js");

var _chrono = require("./chrono.js");

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

// Variables pour le chrono
var clickCount = 1;
var myChrono = new _chrono.Chrono("time");
var btnChrono = document.getElementById("btnGo");
var reload = document.getElementById("btnReload"); // Variables multiplication

var aMultiplier = [2, 3, 4, 5, 6, 7, 8, 9];
var multiplicateur = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
var i = 0;
var nb1 = null;
var nb2 = null;
var table = "Toutes ";
var melange = "mélangées"; // Récupérer les éléments à modifier

var chiffre1 = document.getElementById("chiffre1");
var chiffre2 = document.getElementById("chiffre2");
var chiffre3 = document.getElementById("chiffre3");
var comment = document.getElementById("comment"); // Variable de session

var pseudo = document.getElementById("pseudo").innerText;
var visiteur = "visiteuse ou visiteur";
var location = "./raceViews/marathonView.php"; // La licorne

var licorne = document.createElement("img");
licorne.src = "images/licorne-detouree.png";
licorne.style.position = "relative";
licorne.style.bottom = "20px";
document.getElementById("start_finish").appendChild(licorne); // Préparer les données

var couplesMultiplications = (0, _fonctions.couplerTous)(aMultiplier, multiplicateur);
var couplesMelanges = (0, _fonctions.melanger)(couplesMultiplications); // Charger les premières valeurs

chiffre1.textContent = "-";
chiffre2.textContent = "-"; //#################### CHRONO #################

btnChrono.addEventListener("click", function (event) {
  clickCount++; // OK si course remise à 0

  if (i === 0) {
    if (clickCount % 2 == 0) {
      myChrono.debut = +new Date();
      myChrono.startChrono();

      var _couplesMelanges$ = _slicedToArray(couplesMelanges[0], 2);

      nb1 = _couplesMelanges$[0];
      nb2 = _couplesMelanges$[1];
      chiffre1.textContent = nb1;
      chiffre2.textContent = nb2;
      comment.textContent = "C'est parti !";
      i++;
      clickCount = 2;
    } else {
      myChrono.stopChrono();
    }
  } else {
    comment.textContent = 'Clique sur "Refaire une course"';
  }
}); // ################### GESTION MULTIPLICATION ###########

chiffre3.addEventListener("change", function (event) {
  // On vérifie si le chrono est lancé
  if (clickCount % 2 == 0) {
    // Récupérer les valeurs
    var nb3 = document.getElementById("chiffre3").value;
    var result = nb1 * nb2; // Vérification réponse et on est pas à la fin

    if (result == nb3 && i <= couplesMelanges.length - 1) {
      comment.innerText = "oui, c'est bon...";

      var _couplesMelanges$i = _slicedToArray(couplesMelanges[i], 2);

      nb1 = _couplesMelanges$i[0];
      nb2 = _couplesMelanges$i[1];
      chiffre1.textContent = nb1;
      chiffre2.textContent = nb2;
      chiffre3.value = ""; // variable de choix des éléments de la course à modifier

      var blocModifie = "bloc" + i; // On récupère l'élément à modifier, on le colore et on ajoute la licorne

      var elmtModifie = document.getElementById(blocModifie);
      elmtModifie.style.backgroundColor = "#3f3fe1"; // Rotation de la licorne

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
        chiffre3.value = ""; // On finit les modifications de couleur

        document.getElementById("bloc80").style.backgroundColor = "#3f3fe1"; // On positionne la licorne dans le bloc arrivée

        document.getElementById("start_finish").appendChild(licorne); // On créé les bouton pour enregistrer le temps et quitter

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
        (0, _fonctions.play)(winner, "anim_gagnant"); // on affiche le temps dans le message au gagnant

        winnerTime = document.getElementById("winnerTime");
        winnerTime.innerText = myChrono.tempsAffiche; // On différençie si visiteur ou non

        if (pseudo != visiteur) {
          var enregistrer = document.getElementById("enregistrer");
          enregistrer.addEventListener("click", function (event) {
            document.location.href = "./index.php?time=record&duration=" + document.getElementById("time").innerText + "&table=" + table + "&mixed=" + melange + "&location=" + location;
          });
        } else {
          document.getElementById("winnerBtn").removeChild(btnEnregistrer);
          var btnIndex = document.createElement("button");
          btnIndex.setAttribute("id", "index");
          btnIndex.innerText = "Choisir un pseudo";
          document.getElementById("winnerBtn").appendChild(btnIndex);
          btnIndex.addEventListener("click", function (event) {
            document.location.href = "./index.php";
          });
          document.getElementById("winnerMsg").innerHTML = "<p style='font-size: 18px'>Félicitation, c'est gagné !<br>Choisis un pseudo pour pouvoir enregistrer ton temps.</p>";
        }
      } else {
        comment.innerText = "Oups ! ce n'est pas la bonne réponse...";
      }
    }
  } else {
    comment.innerText = "Il faut lancer le chrono";
  }
});
reload.addEventListener("click", function (event) {
  document.location.reload();
});