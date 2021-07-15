"use strict";

let btnGetAllEntries = document.getElementById("getAllEntries");
let btnEditEntries = document.getElementById("edit-button");
let btnDeleteEntries = document.getElementById("delete-button");
const ALL_ENTRIES = document.getElementById("allEntries");
const LAST_ENTRIES = document.getElementById("lastEntries");
const ENTRY = document.getElementById("entry");

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

if (btnEditEntries) {
  btnEditEntries.addEventListener("click", () => {
    console.log("hola");
    ENTRY.innerHTML = " <?php require_once('includes/edit_entry.php'); ?> ";
  });
}
