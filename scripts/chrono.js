// Ce script créé un objet "chrono" et ses méthodes d'instance de démarrage et d'arrêt.

class Chrono {
  constructor(element) {
    this.debut = new Date();
    this.tempsAffiche = "?";
    this.element = element;
    this.interval = null;
    this.totalDuration = 0;
  }

  startChrono() {

    const aRepeter = () => {

      // On récupère le temps passé depuis le début
      let tempsPasse = new Date() - this.debut;
      // On formate les minutes et secondes
      let minutes = Math.floor(tempsPasse / (1000 * 60));
      let secondes = Math.floor((tempsPasse / 1000) % 60);
      // On forme la valeur à afficher et on la charge
      this.tempsAffiche = minutes + " mn " + secondes + " s";
      document.getElementById(this.element).innerText = this.tempsAffiche;
    }
    this.interval = setInterval(aRepeter, 1000);
  }

  stopChrono() {
    this.totalDuration = Math.floor((new Date() - this.debut) / 1000);
    clearInterval(this.interval);
    this.debut = null;
  }
}

export { Chrono };
