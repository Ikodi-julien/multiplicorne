"use strict";

var getRaceView = function getRaceView() {
  var selectRaces = document.querySelector('#selectRaces');
  selectRaces.addEventListener('change', function (event) {
    var selectedRace = event.target.value; // redirection en fonction du select

    switch (selectedRace) {
      case 'addition':
        console.log('addition');
        document.location.href = "./raceRouteur.php?race=sprint&op=add";
        break;

      case 'soustraction':
        console.log('soustraction');
        document.location.href = "./raceRouteur.php?race=sprint&op=sub";
        break;

      case 'multiplication':
        console.log('multiplication');
        document.location.href = "./raceRouteur.php?race=sprint&op=multipli";
        break;

      case 'marathonAddSub':
        console.log('marathonAdd');
        document.location.href = "./raceRouteur.php?race=marathon&op=add_sub";
        break;

      case 'marathonMulti':
        console.log('marathonMulti');
        document.location.href = "./raceRouteur.php?race=marathon&op=multipli";
        break;

      default:
        document.location.href = "./raceRouteur.php";
        break;
    }
  });
};

document.addEventListener('DOMContentLoaded', getRaceView);