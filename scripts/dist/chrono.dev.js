"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Chrono = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// Ce script créé un objet "chrono" et ses méthodes d'instance de démarrage et d'arrêt.
var Chrono =
/*#__PURE__*/
function () {
  function Chrono(element) {
    _classCallCheck(this, Chrono);

    this.debut = new Date();
    this.tempsAffiche = "?";
    this.element = element;
    this.interval = null;
    this.totalDuration = 0;
  }

  _createClass(Chrono, [{
    key: "startChrono",
    value: function startChrono() {
      var _this = this;

      var aRepeter = function aRepeter() {
        // On récupère le temps passé depuis le début
        var tempsPasse = new Date() - _this.debut; // On formate les minutes et secondes

        var minutes = Math.floor(tempsPasse / (1000 * 60));
        var secondes = Math.floor(tempsPasse / 1000 % 60); // On forme la valeur à afficher et on la charge

        _this.tempsAffiche = minutes + " mn " + secondes + " s";
        document.getElementById(_this.element).innerText = _this.tempsAffiche;
      };

      this.interval = setInterval(aRepeter, 1000);
    }
  }, {
    key: "stopChrono",
    value: function stopChrono() {
      this.totalDuration = Math.floor((new Date() - this.debut) / 1000);
      clearInterval(this.interval);
      this.debut = null;
    }
  }]);

  return Chrono;
}();

exports.Chrono = Chrono;