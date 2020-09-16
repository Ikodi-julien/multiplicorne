"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.play = play;
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