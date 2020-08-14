// Fonction créant un array avec tous les couples de multiplications
const coupler = (nb, multiplicateur) => {
    let array = [];
    for (let i = 0; i < 9; i++) {
        array.push([nb, multiplicateur[i]]);
    };
    return array;
}

// Fonction pour mélanger la liste de couples de multiplication
const melanger = (array) => {
    for (let position = array.length - 1; position >= 1; position--) {
        // Obtenir un nombre aléatoire entre 0 et 10
        let nbAleatoire = Math.floor(Math.random() * array.length);
        // Remplacer le dernier element par un élement aléatoire, puis n-1 élément
        let sauv = array[position];
        array[position] = array[nbAleatoire];
        array[nbAleatoire] = sauv;
    };
    return array;
}

// Fonction créant un array avec tous les couples de multiplications
const couplerTous = (aMultiplier, multiplicateur) => {
    let array = [];
    for ( let i = 0; i < 8; i++) {
        for ( let j = 0; j < 10; j++) {
            array.push([aMultiplier[i], multiplicateur[j]]);
        };
    };
    return array;
}

export {coupler, melanger, couplerTous };