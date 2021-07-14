"use strict";
console.log("Hola");
document.addEventListener("DOMContentLoaded", function (event) {
  console.log("DOM fully loaded and parsed");

  let btnGetAllEntries = document.getElementById("getAllEntries");
  const ALL_ENTRIES = document.getElementById('allEntries')
  const LAST_ENTRIES = document.getElementById('lastEntries')

  btnGetAllEntries.addEventListener("click", () => {
      console.log('hola');
    LAST_ENTRIES.style.display = 'none';
    ALL_ENTRIES.style.display = 'block';
    btnGetAllEntries.style.display = 'none';
  });
});
