const avatar = document.querySelector('.avatarProfil');
const avatarToggle= document.getElementById('avatarProfilToggle');

avatarToggle.addEventListener('click', () => {
    avatar.classList.toggle('extend');
    avatar.classList.toggle('shrink');
});

const decor = document.querySelector('.decorProfil');
const decorToggle= document.getElementById('decorProfilToggle');

decorToggle.addEventListener('click', () => {
    decor.classList.toggle('extend');
    decor.classList.toggle('shrink');
});

const photoProfil = document.querySelector('.photoProfil');
const photoProfilToggle= document.getElementById('photoProfilToggle');

photoProfilToggle.addEventListener('click', () => {
    photoProfil.classList.toggle('extend');
    photoProfil.classList.toggle('shrink');
});

const birthDate = document.querySelector('.birthDateProfil');
const birthDateToggle= document.getElementById('birthDateProfilToggle');

birthDateToggle.addEventListener('click', () => {
    birthDate.classList.toggle('extend');
    birthDate.classList.toggle('shrink');
});

const pseudoProfil = document.querySelector('.pseudoProfil');
const pseudoProfilToggle= document.getElementById('pseudoProfilToggle');

pseudoProfilToggle.addEventListener('click', () => {
    pseudoProfil.classList.toggle('extend');
    pseudoProfil.classList.toggle('shrink');
});

const emailProfil = document.querySelector('.emailProfil');
const emailProfilToggle= document.getElementById('emailProfilToggle');

emailProfilToggle.addEventListener('click', () => {
    emailProfil.classList.toggle('extend');
    emailProfil.classList.toggle('shrink');
});

const passProfil = document.querySelector('.passProfil');
const passProfilToggle= document.getElementById('passProfilToggle');

passProfilToggle.addEventListener('click', () => {
    passProfil.classList.toggle('extend');
    passProfil.classList.toggle('shrink');
});