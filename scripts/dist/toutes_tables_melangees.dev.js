"use strict";

var _fonctions = require("./fonctions.js");

var _chrono = require("./chrono.js");

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

// Variables pour le chrono
var clickCount = 1;
var myChrono = new _chrono.Chrono("temps");
var btnChrono = document.getElementById("bouton_chrono");
var reload = document.getElementById("reload");
var temps = document.getElementById("temps").innerText; // Variables multiplication

var aMultiplier = [2, 3, 4, 5, 6, 7, 8, 9];
var multiplicateur = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
var i = 0;
var nb1 = null;
var nb2 = null; // Récupérer les éléments à modifier

var chiffre1 = document.getElementById("chiffre1");
var chiffre2 = document.getElementById("chiffre2");
var chiffre3 = document.getElementById("chiffre3");
var avis = document.getElementById("avis"); // Variable de session

var pseudo = document.getElementById("nom_coureur").innerText;
var visiteur = "visiteuse ou visiteur"; // Préparer les données

var couplesMultiplications = (0, _fonctions.couplerTous)(aMultiplier, multiplicateur);
var couplesMelanges = (0, _fonctions.melanger)(couplesMultiplications); // Charger les premières valeurs

chiffre1.textContent = "-";
chiffre2.textContent = "-"; // La licorne

var licorne = document.createElement("img");
licorne.src = "images/licorne-detouree.png";
document.getElementById("depart_arrivee").appendChild(licorne); //#################### CHRONO #################

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
      avis.textContent = "C'est parti !";
      i++;
      return clickCount = 2;
    } else {
      myChrono.stopChrono();
    }
  } else {
    avis.textContent = 'Clique sur "Refaire une course"';
  }
}); // ################### GESTION MULTIPLICATION ###########

chiffre3.addEventListener("change", function (event) {
  // On vérifie si le chrono est lancé
  if (clickCount % 2 == 0) {
    // Récupérer les valeurs
    var nb3 = document.getElementById("chiffre3").value;
    var result = nb1 * nb2; // Vérification réponse et on est pas à la fin

    if (result == nb3 && i <= couplesMelanges.length - 76) {
      avis.innerText = "oui, c'est bon...";

      var _couplesMelanges$i = _slicedToArray(couplesMelanges[i], 2);

      nb1 = _couplesMelanges$i[0];
      nb2 = _couplesMelanges$i[1];
      chiffre1.textContent = nb1;
      chiffre2.textContent = nb2;
      chiffre3.value = ""; // variable de choix des éléments de la course à modifier

      var blocModifie = "bloc" + i; // On récupère l'élément à modifier, on le colore et on ajoute la licorne

      var elmtModifie = document.getElementById(blocModifie);
      elmtModifie.style.backgroundColor = "#3f3fe1"; // Rotation de la licorne

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
        chiffre3.value = ""; // On finit les modifications de couleur

        document.getElementById("bloc80").style.backgroundColor = "#3f3fe1"; // On positionne la licorne dans le bloc arrivée

        document.getElementById("depart_arrivee").appendChild(licorne); // On créé les bouton pour enregistrer le temps et quitter

        var btnEnregistrer = document.createElement("div");
        btnEnregistrer.setAttribute("id", "enregistrer");
        btnEnregistrer.innerText = "Enregistrer";
        document.getElementById("winner_button").appendChild(btnEnregistrer);
        var btnQuitter = document.createElement("div");
        btnQuitter.setAttribute("id", "quitter");
        btnQuitter.innerText = "Retour";
        document.getElementById("winner_button").appendChild(btnQuitter);
        btnQuitter.addEventListener("click", function (event) {
          document.location.reload(true);
        }); // On envoi le message pour le gagnant

        var fondGagnant = document.getElementById("fond_gagnant");
        var cadreGagnant = document.getElementById("cadre_gagnant");
        (0, _fonctions.play)(fondGagnant, "anim_gagnant");
        (0, _fonctions.play)(cadreGagnant, "anim_gagnant"); // on affiche le temps dans le message au gagnant

        var affichageTemps = document.getElementById("affichage_temps");
        affichageTemps.innerText = myChrono.tempsAffiche; // On différençie si visiteur ou non pour enregistrer le temps

        var enregistrer = document.getElementById("enregistrer");
        enregistrer.addEventListener("click", function (event) {
          if (pseudo != visiteur) {
            document.location.href = "./enregistrer_temps.php?temps=" + document.getElementById("temps").innerText + "&table_multiplication=" + table + "&melange=" + melange + "&page=page_table_unique.php";
          } else {
            document.getElementById("winner_button").removeChild(btnEnregistrer);
            var btnIndex = document.createElement("a");
            btnIndex.setAttribute("id", "index");
            btnIndex.setAttribute("href", "index.php");
            btnIndex.innerText = "Choisir un pseudo";
            document.getElementById("winner_button").appendChild(btnIndex);
            var winnerTime = document.getElementById("winner_time");
            document.getElementById("cadre_gagnant").removeChild(winnerTime);
            document.getElementById("winner_msg").innerHTML = "Choisis un pseudo pour pouvoir enregistrer ton temps.";
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
reload.addEventListener("click", function (event) {
  document.location.reload(true);
});