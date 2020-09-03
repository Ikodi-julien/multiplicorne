"use strict";

var _fonctions = require("./fonctions.js");

var _chrono = require("./chrono.js");

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

//Variables chrono
var clickCount = 0;
var myChrono = new _chrono.Chrono("temps");
var btnChrono = document.getElementById("bouton_chrono");
var reload = document.getElementById("reload"); // Variables multiplication

var multiplicateur = [2, 3, 4, 5, 6, 7, 8, 9, 10];
var couplesMultiplications = [];
var i = 0;
var nb1 = null;
var nb2 = null; // Récupérer les éléments à modifier

var chiffre1 = document.getElementById("chiffre1");
var chiffre2 = document.getElementById("chiffre2");
var chiffre3 = document.getElementById("chiffre3");
var avis = document.getElementById("avis"); // Variable de session

var pseudo = document.getElementById("nom_coureur").innerText;
var visiteur = "visiteuse ou visiteur"; // La licorne

var licorne = document.createElement("img");
licorne.src = "./images/licorne-detouree.png";
document.getElementById("bloc0").appendChild(licorne);
avis.innerText = 'Choisis une table, mélangée ou non et clique sur "GO" pour démarrer le chrono'; //################ Boucle principale ####################

btnChrono.addEventListener("click", function (event) {
  // OK si course au début et table choisie
  var table = document.getElementById("tables").value;

  if (table != "-") {
    // Préparer les données
    var sontCouples = (0, _fonctions.coupler)(table, multiplicateur); // Mélanger si demandé

    var melange = document.querySelector('input[name="melange"]:checked').value;

    if (melange == "mélangée") {
      couplesMultiplications = (0, _fonctions.melanger)(sontCouples);
    } else {
      couplesMultiplications = sontCouples;
    }

    if (i == 0 && clickCount < 1) {
      clickCount++; // Démarrer le chrono

      myChrono.stopChrono();
      myChrono.debut = +new Date();
      myChrono.startChrono();

      var _couplesMultiplicatio = _slicedToArray(couplesMultiplications[0], 2);

      nb1 = _couplesMultiplicatio[0];
      nb2 = _couplesMultiplicatio[1];
      i++;
      chiffre1.textContent = nb1;
      chiffre2.textContent = nb2;
      avis.textContent = "C'EST PARTI !!!"; // Modifier les éléments si réponse modifiée

      chiffre3.addEventListener("change", function (event) {
        document.getElementById("bloc0").style.backgroundColor = "#3f3fe1"; // Récupérer les valeurs

        var nb3 = document.getElementById("chiffre3").value;
        var result = nb1 * nb2; // Vérification réponse et on est pas à la fin

        if (result == nb3 && i < couplesMultiplications.length) {
          avis.innerText = "oui, c'est bon...";

          var _couplesMultiplicatio2 = _slicedToArray(couplesMultiplications[i], 2);

          nb1 = _couplesMultiplicatio2[0];
          nb2 = _couplesMultiplicatio2[1];
          chiffre1.textContent = nb1;
          chiffre2.textContent = nb2;
          chiffre3.value = ""; // variable de choix des éléments de la course à modifier

          var blocModifie = "bloc" + i; // On récupère l'élément à modifier, on le colore et on ajoute la licorne

          var elmtModifie = document.getElementById(blocModifie);
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
            chiffre3.value = ""; // On finit les modifications de couleur

            document.getElementById("bloc_fin").style.backgroundColor = "#3f3fe1"; // On positionne la licorne dans le dernier

            document.getElementById("bloc_fin").appendChild(licorne); // On créé les boutons pour enregistrer le temps ou quitter

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
            affichageTemps.innerText = myChrono.tempsAffiche; // On différençie si visiteur ou non

            if (pseudo != visiteur) {
              var enregistrer = document.getElementById("enregistrer");
              enregistrer.addEventListener("click", function (event) {
                document.location.href = "./index.php?time=record&duration=" + document.getElementById("temps").innerText + "&table=" + table + "&mixed=" + melange + "&location=sprintView.php";
              });
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
reload.addEventListener("click", function (event) {
  document.location.reload(true);
});