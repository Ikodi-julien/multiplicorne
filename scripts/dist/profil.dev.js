"use strict";

var front = document.querySelector('.front');
var toggle = document.querySelector('.toggle');
toggle.addEventListener('click', function () {
  front.classList.toggle('extend');
  front.classList.toggle('shrink');
});