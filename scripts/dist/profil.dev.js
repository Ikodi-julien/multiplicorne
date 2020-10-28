"use strict";

var avatar = document.querySelector('.avatarProfil');
var avatarToggle = document.getElementById('avatarProfilToggle');
avatarToggle.addEventListener('click', function () {
  avatar.classList.toggle('extend');
  avatar.classList.toggle('shrink');
});
var decor = document.querySelector('.decorProfil');
var decorToggle = document.getElementById('decorProfilToggle');
decorToggle.addEventListener('click', function () {
  decor.classList.toggle('extend');
  decor.classList.toggle('shrink');
});
var photoProfil = document.querySelector('.photoProfil');
var photoProfilToggle = document.getElementById('photoProfilToggle');
photoProfilToggle.addEventListener('click', function () {
  photoProfil.classList.toggle('extend');
  photoProfil.classList.toggle('shrink');
});
var birthDate = document.querySelector('.birthDateProfil');
var birthDateToggle = document.getElementById('birthDateProfilToggle');
birthDateToggle.addEventListener('click', function () {
  birthDate.classList.toggle('extend');
  birthDate.classList.toggle('shrink');
});
var pseudoProfil = document.querySelector('.pseudoProfil');
var pseudoProfilToggle = document.getElementById('pseudoProfilToggle');
pseudoProfilToggle.addEventListener('click', function () {
  pseudoProfil.classList.toggle('extend');
  pseudoProfil.classList.toggle('shrink');
});
var emailProfil = document.querySelector('.emailProfil');
var emailProfilToggle = document.getElementById('emailProfilToggle');
emailProfilToggle.addEventListener('click', function () {
  emailProfil.classList.toggle('extend');
  emailProfil.classList.toggle('shrink');
});
var passProfil = document.querySelector('.passProfil');
var passProfilToggle = document.getElementById('passProfilToggle');
passProfilToggle.addEventListener('click', function () {
  passProfil.classList.toggle('extend');
  passProfil.classList.toggle('shrink');
});