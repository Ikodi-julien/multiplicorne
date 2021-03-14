import { getRaceView } from "./racesMenu.js";
import { handleProfilToggle } from "./profil.js";
import { race } from "./race.js";

document.addEventListener('DOMContentLoaded', () => {

  const urlParams = new URLSearchParams(window.location.search);

  // Execute si sur page profil
  if (urlParams.get('profil') !== null) {
    handleProfilToggle.addListenerToElt();
  }

  // Gère le routage suite au choix dans le select
  getRaceView();

  // Execute si sur une page de course
  if (urlParams.get('race') !== null && urlParams.get('race') !== 'index') {

    race(urlParams);
  }
});
