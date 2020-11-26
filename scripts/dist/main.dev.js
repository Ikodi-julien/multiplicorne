"use strict";

var _fonctions = require("./fonctions.js");

var _chrono = require("./chrono.js");

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

//Variables chrono
var clickCount = 0;
var myChrono = new _chrono.Chrono("time");
var btnChrono = document.getElementById("btnGo");
var reload = document.getElementById("btnReload"); // Variables multiplication

var aMultiplier = [2, 3, 4, 5, 6, 7, 8, 9];
var multiplicateur = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
var couplesMultiplications = [];
var couplesMelanges = [];
var i = 0;
var nb1 = null;
var nb2 = null;
var table = "";
var melange = ""; // Récupérer les éléments à modifier

var chiffre1 = document.getElementById("chiffre1");
var chiffre2 = document.getElementById("chiffre2");
var chiffre3 = document.getElementById("chiffre3");
var comment = document.getElementById("comment"); // Variable de session

var pseudo = document.getElementById("pseudo").innerText;
var visiteur = "visiteur.euse";
var pageUrl = document.location.href;
var page = pageUrl.substring(pageUrl.length - 6);
var location = ""; // L'avatar

var avatarName = document.getElementById("avatarName").innerText;
var avatar = document.createElement("img");
avatar.src = "./images/" + avatarName + ".png";
avatar.style.position = "relative";
avatar.style.bottom = "20px"; // Ajustement des constante selon la page

if (page == "sprint") {
  var _location = "./raceViews/sprintView.php";
  document.getElementById("bloc0").appendChild(avatar);
  comment.innerText = 'Choisis une table, mélangée ou non et clique sur "GO" pour démarrer le chrono';
} else if (page == "rathon") {
  location = "./raceViews/marathonView.php";
  table = "Toutes ";
  melange = "mélangées";
  document.getElementById("start_finish").appendChild(avatar); // Préparer les données

  couplesMultiplications = (0, _fonctions.couplerTous)(aMultiplier, multiplicateur);
  couplesMelanges = (0, _fonctions.melanger)(couplesMultiplications); // Charger les premières valeurs

  chiffre1.textContent = "-";
  chiffre2.textContent = "-";
} else {
  comment.innerText = "Page pas reconnue";
} //################ Boucle principale ####################


btnChrono.addEventListener("click", function (event) {
  // OK si course au début et table choisie
  if (page == "sprint") {
    table = document.getElementById("tables").value;

    if (table == "-") {
      comment.innerText = "Il faut choisir une table !!";
      return;
    } else {
      // Préparer les données
      var sontCouples = (0, _fonctions.coupler)(table, multiplicateur); // Mélanger si demandé

      melange = document.querySelector('input[name="melange"]:checked').value;

      if (melange == "mélangée") {
        couplesMelanges = (0, _fonctions.melanger)(sontCouples);
      } else {
        couplesMelanges = sontCouples;
      }
    }
  } // Démarrage du chrono si pas de multiplication déjà faites


  if (i == 0 && clickCount == 0) {
    clickCount++; // Démarrer le chrono

    myChrono.stopChrono();
    myChrono.debut = +new Date();
    myChrono.startChrono();

    var _couplesMelanges$ = _slicedToArray(couplesMelanges[0], 2);

    nb1 = _couplesMelanges$[0];
    nb2 = _couplesMelanges$[1];
    i++;
    chiffre1.textContent = nb1;
    chiffre2.textContent = nb2;
    comment.textContent = "C'EST PARTI !!!"; // Modifier les éléments si réponse modifiée

    chiffre3.addEventListener("change", function (event) {
      if (page == "sprint") {
        document.getElementById("bloc0").style.backgroundColor = "#3f3fe1";
      } // Récupérer les valeurs


      var nb3 = document.getElementById("chiffre3").value;
      var result = nb1 * nb2; // Vérification réponse et on est pas à la fin

      if (result == nb3 && i < couplesMelanges.length) {
        comment.innerText = "Oui, c'est la bonne réponse !";

        var _couplesMelanges$i = _slicedToArray(couplesMelanges[i], 2);

        nb1 = _couplesMelanges$i[0];
        nb2 = _couplesMelanges$i[1];
        chiffre1.textContent = nb1;
        chiffre2.textContent = nb2;
        chiffre3.value = ""; // variable de choix des éléments de la course à modifier

        var blocModifie = "bloc" + i; // On récupère l'élément à modifier, on le colore et on ajoute l'avatar

        var elmtModifie = document.getElementById(blocModifie);
        elmtModifie.style.backgroundColor = "#3f3fe1"; // Prévoir positionnement différent selon page

        if (page == "sprint") {
          elmtModifie.appendChild(avatar);
        } else if (page == "rathon") {
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
        if (result == nb3 && i == couplesMelanges.length) {
          if (page == "rathon") {
            clickCount++; // On finit les modifications de couleur

            document.getElementById("bloc80").style.backgroundColor = "#3f3fe1"; // On positionne l'avatar dans le bloc arrivée

            document.getElementById("start_finish").appendChild(avatar);
          } else if (page == "sprint") {
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
          (0, _fonctions.play)(winner, "anim_gagnant"); // on affiche le temps dans le message au gagnant

          var winnerTime = document.getElementById("winnerTime");
          winnerTime.innerText = myChrono.tempsAffiche; // On différençie si visiteur ou non

          if (pseudo != visiteur) {
            var enregistrer = document.getElementById("enregistrer");
            enregistrer.addEventListener("click", function (event) {
              document.location.href = "./raceRouteur.php?time=record&duration=" + document.getElementById("time").innerText + "&table=" + table + "&mixed=" + melange + "&location=" + location;
            });
          } else {
            // document.getElementById("winnerBtn").removeChild(btnEnregistrer);
            var btnIndex = document.createElement("button");
            btnIndex.setAttribute("id", "index");
            btnIndex.innerText = "Créer un compte";
            document.getElementById("winnerBtn").appendChild(btnIndex);
            btnIndex.addEventListener("click", function (event) {
              document.location.href = "./index.php";
            }); // document.getElementById("winnerMsg").innerHTML =
            //   "Félicitation, c'est gagné !<br>Choisis un pseudo pour pouvoir enregistrer ton temps.";

            var _enregistrer = document.getElementById("enregistrer");

            _enregistrer.addEventListener("click", function (event) {
              document.location.href = "./raceRouteur.php?time=record&duration=" + document.getElementById("time").innerText + "&table=" + table + "&mixed=" + melange + "&location=" + location;
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