"use strict";

let btnMenu = document.getElementById("menu-button");
let btnGetAllEntries = document.getElementById("getAllEntries");
let btnEditEntries = document.getElementById("edit-button");
let btnDeleteEntries = document.getElementById("delete-button");
const RESPONSIVE_MENU = document.getElementById("menu");
const ALL_ENTRIES = document.getElementById("allEntries");
const LAST_ENTRIES = document.getElementById("lastEntries");
const ENTRY = document.getElementById("entry");

// Toggle menu
btnMenu.addEventListener("click", () => {
  console.log("Hola");
  if (RESPONSIVE_MENU.classList.contains("open")) {
    RESPONSIVE_MENU.classList.remove("open");
  } else {
    RESPONSIVE_MENU.classList.add("open");
  }
});

if (btnGetAllEntries) {
  btnGetAllEntries.addEventListener("click", () => {
    console.log("hola");
    LAST_ENTRIES.style.display = "none";
    ALL_ENTRIES.style.display = "block";
    btnGetAllEntries.style.display = "none";
  });
}

if (btnDeleteEntries) {
  let confirmIt = function (e) {
    if (!confirm("Are you sure?")) e.preventDefault();
  };
  btnDeleteEntries.addEventListener("click", confirmIt, false);
}
