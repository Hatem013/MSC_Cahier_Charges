function showColorFields() {
  var nombreCouleurs = document.getElementById("nombre-couleurs").value;

  // Affiche les champs de couleur et les labels en fonction du nombre sélectionné
  for (var i = 1; i <= 3; i++) {
    var couleurField = document.getElementById("couleur" + i);
    var couleurLabel = document.getElementById("label-couleur" + i);

    if (i <= nombreCouleurs) {
      couleurField.style.display = "block";
      couleurLabel.style.display = "block";
    } else {
      couleurField.style.display = "none";
      couleurLabel.style.display = "none";
    }
  }
}
function showLogoFields() {
  var logoOui = document.getElementById("logo_oui");
  var logoNon = document.getElementById("logo_non");
  var logoFileField = document.getElementById("logo-file-field");
  var createLogoField = document.getElementById("create-logo-field");
  var logo_preview = document.getElementById("logo_file_preview");
  var logo_file = document.getElementById("logo_file");

  // Affiche la preview si "Oui" est sélectionné, sinon affiche le message 
  
    if (logoOui.checked) {
    logoFileField.style.display = "block";
    createLogoField.style.display = "none";

    logo_file.required = true;

    if (logo_file.files.length == 0) {
      logo_file_preview.style.display = "none";
    } else {
      logo_file_preview.style.display = "unset";
    }
  } else if (logoNon.checked) {
    logoFileField.style.display = "none";

    createLogoField.style.display = "block";

    logo_preview.style.display = "none";

    logo_file.required = false;
  }
}

/* color picker test (ne pas toucher)
var test1 = document.getElementById("couleur" + 1);
var test2 = document.getElementById("label-couleur" + 1);
var test3 = document.getElementById("lblclr");

test1.addEventListener("change", testing);

function testing() {
  test3.style.backgroundColor = test1.value;
}
*/


// Client3
var header_d = document.getElementById("header_desktop_btn");
var header_d_c = document.getElementById("header_desktop_card");
var header_m_c = document.getElementById("header_mobile_card");

var header_collapse = document.querySelectorAll(".collapse")[1];
var header_mobile_collapse = document.querySelectorAll(".collapse")[2];


var header_desktop = document.querySelectorAll(".header_desktop")

for (var i = 0; i<header_desktop.length; i++) {

  header_desktop[i].addEventListener("click", colorUpdate);
}

function colorUpdate() {

header_d.classList.add("btn_validate");

var collapse = new bootstrap.Collapse(header_collapse);
var collapsing = new bootstrap.Collapse(header_mobile_collapse);


}

console.log(header_desktop)




