"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.play = play;
exports.createAdditions = createAdditions;
exports.couplerTous = exports.melanger = exports.coupler = void 0;

// Fonction créant un array avec tous les couples de multiplications
var coupler = function coupler(nb, multiplicateur) {
  var array = [];

  for (var i = 0; i < 10; i++) {
    array.push([nb, multiplicateur[i]]);
  }

  return array;
}; // Fonction pour mélanger la liste de couples de multiplication


exports.coupler = coupler;

var melanger = function melanger(array) {
  for (var position = array.length - 1; position >= 1; position--) {
    // Obtenir un nombre aléatoire entre 0 et 10
    var nbAleatoire = Math.floor(Math.random() * array.length); // Remplacer le dernier element par un élement aléatoire, puis n-1 élément

    var sauv = array[position];
    array[position] = array[nbAleatoire];
    array[nbAleatoire] = sauv;
  }

  return array;
}; // Fonction créant un array avec tous les couples de multiplications


exports.melanger = melanger;

var couplerTous = function couplerTous(aMultiplier, multiplicateur) {
  var array = [];

  for (var i = 0; i < 8; i++) {
    for (var j = 0; j < 10; j++) {
      array.push([aMultiplier[i], multiplicateur[j]]);
    }
  }

  return array;
}; // Fonction pour jouer une animation


exports.couplerTous = couplerTous;

function play(elt, class_name) {
  window.requestAnimationFrame(function (time) {
    window.requestAnimationFrame(function (time) {
      elt.classList.add(class_name);
    });
  });
}
/**
 * Creates 15 additions using numbers within 2 - 99
 */


function createAdditions() {
  var additions = [];

  for (var rounds = 15; rounds > 0; rounds--) {
    additions.push([Math.floor(Math.random() * 98 + 2), Math.floor(Math.random() * 98 + 2)]);
  }

  return additions;
}

function prepareView(page) {
  var pageDetails = {
    location: null,
    startElt: null,
    comment: null,
    table: null,
    multiMix: null,
    multiStraight: null
  }; // page est les 6 dernières lettre de race= dans l'url

  if (page == "ltipli") {
    pageDetails.location = "./raceViews/multipliView.php";
    pageDetails.startElt = "bloc0";
    pageDetails.comment = 'Choisis une table, mélangée ou non et clique sur "GO" pour démarrer le chrono';
  } else if (page == "rathon") {
    pageDetails.location = "./raceViews/marathonView.php";
    pageDetails.table = "Toutes ";
    pageDetails.melange = "mélangées";
    pageDetails.startElt = "start_finish"; // Préparer les données

    couplesMultiplications = couplerTous(aMultiplier, multiplicateur);
    couplesMelanges = melanger(couplesMultiplications); // Charger les premières valeurs

    chiffre1.textContent = "-";
    chiffre2.textContent = "-";
  } else if (page == "ce=add") {
    location = "./raceViews/add-subView.php";
    table = null;
    melange = null;
    document.getElementById("bloc0").appendChild(avatar); // Préparer les données selon les options choisies
    // - addition / soustraction / les deux,
    // - soustractions négatives ou non ?
    // Si addition seulement, faire une liste de 15 additions,

    var additions = createAdditions();
    console.log(additions); // Si soustractions seulement, faire une liste de 15 soustractions,
    // Si additions et soustractions mélangées on concatène les deux 
    // listes pour un total de 30 résultats à trouver.
    // Charger les premières valeurs

    chiffre1.textContent = "-";
    chiffre2.textContent = "-";
  } else {
    comment.innerText = "Page pas reconnue ".concat(page);
  }
}