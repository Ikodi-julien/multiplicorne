export const utils = {

  /*------------------------------*/
  /* --- OPERATIONS FUNCTIONS --- */
  /*------------------------------*/

  aMultiplier: [2, 3, 4, 5, 6, 7, 8, 9],
  multiplicateur: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],

  /**
   * Fonction créant un array avec tous les couples de multiplications
   */
  makeCouples: (tableNb) => {
    let array = [];
    for (let i = 0; i < 10; i++) {
      array.push(['x', tableNb, utils.multiplicateur[i]]);
    }
    return array;
  },

  /**
   * Fonction pour mélanger la liste de couples de multiplication 
   */
  mix: (array) => {
    for (let position = array.length - 1; position >= 1; position--) {
      // Obtenir un nombre aléatoire entre 0 et 10
      let nbAleatoire = Math.floor(Math.random() * array.length);
      // Remplacer le dernier element par un élement aléatoire, puis n-1 élément
      let sauv = array[position];
      array[position] = array[nbAleatoire];
      array[nbAleatoire] = sauv;
    }
    return array;
  },

  // Fonction créant un array avec tous les couples de multiplications
  coupleAll: () => {
    let array = [];
    for (let i = 0; i < 8; i++) {
      for (let j = 0; j < 10; j++) {
        array.push(['x', utils.aMultiplier[i], utils.multiplicateur[j]]);
      }
    }
    return array;
  },


  /**
   * Creates 15 additions using numbers within 2 - 99
   */
  createOperations: (rounds, sign) => {

    const operations = [];
    for (let roundIndex = rounds; roundIndex > 0; roundIndex--) {

      operations.push(
      [sign, Math.floor((Math.random() * 98) + 2),
        Math.floor((Math.random() * 8) + 2)])
    }

    return operations
  },

  /*------------------------------*/
  /*-------- DISPLAY FUNCTIONS ---*/
  /*------------------------------*/
  /**
   * Sets globals parameters according to chosen race
   * @param {String} page 
   * @returns 
   */
  prepareView: function(raceType, operationType) {

    const pageDetails = {
      startElt: null,
      comment: null,
      firstNumber: null,
      secondNumber: null,
      sign: null
    }

    // page est les 6 dernières lettre de race= dans l'url
    if (raceType == "sprint") {

      switch (operationType) {
        case "add":
          pageDetails.sign = '+';
          pageDetails.comment =
            'On fait quelques additions ?';
          break;
        case "sub":
          pageDetails.sign = '-';
          pageDetails.comment =
            'On fait quelques soustractions ?';
          break;
        case "multipli":
          pageDetails.sign = 'x';
          pageDetails.comment =
            'Choisis une table, mélangée ou non et clique sur "GO" pour démarrer le chrono';

          break;
        default:
          break;
      }

      pageDetails.startElt = "bloc0";

    } else if (raceType === "marathon") {

      if (operationType === "add_sub") {

        pageDetails.comment = "Le Marathon des additions et soustractions !";
      } else {

        pageDetails.comment = "Le Marathon des Multiplications !";
      }
      pageDetails.startElt = "start_finish";
      pageDetails.firstNumber = "-";
      pageDetails.secondNumber = "-";

    } else {
      pageDetails.comment = `Page pas reconnue ${page}`;
    }

    return pageDetails;
  },

  // Fonction pour jouer une animation
  play: (elt, class_name) => {
    window.requestAnimationFrame(function(time) {
      window.requestAnimationFrame(function(time) {
        elt.classList.add(class_name);
      });
    });
  },
}
