////////////////// Logo ////////////////// 

var logoOui = document.getElementById("logo_oui");
var logoNon = document.getElementById("logo_non");
var logoFileField = document.getElementById("logo_file_field");
var createLogoField = document.getElementById("logo_alert_field");
var logoFilePreview = document.getElementById("logo_file_preview");
var logoFile = document.getElementById("logo_file");

// Affiche la preview si "Oui" est sélectionné, sinon affiche le message
function showLogoFields() {
  if (logoOui.checked) {
    logoFileField.style.display = "unset";
    createLogoField.style.display = "none";
    logoFile.required = true;

    if (logoFile.files.length == 0) {
      logoFilePreview.style.display = "none";
    } else {
      logoFilePreview.style.display = "unset";
    }
  } else if (logoNon.checked) {
    logoFileField.style.display = "none";

    createLogoField.style.display = "unset";

    logoFilePreview.style.display = "none";

    logoFile.required = false;
  }
}

function showLogFields() {
  if (logoOui.checked) {
    logoFileField.style.display = "unset";
    createLogoField.style.display = "none";
    logoFile.required = true;

    if (logoFile.files.length == 0) {
      logoFilePreview.style.display = "none";
    } else {
      logoFilePreview.style.display = "unset";
    }
    
  } else if (logoNon.checked) {
    logoFileField.style.display = "none";

    createLogoField.style.display = "unset";

    logoFilePreview.style.display = "none";

    logoFile.required = false;
  }
}
// Change la couleur du bouton

function logoSelectionValidate() {
  var selected = document.querySelector('input[name="logo"]:checked').value;
  var labelOui = document.getElementById("logo_label_oui");
  var labelNon = document.getElementById("logo_label_non");
  var importLabel = document.getElementById("logo_import_label");

  if (selected == "oui") {
    labelOui.classList.add("btn_validate");
    labelNon.classList.remove("btn_validate");
    importLabel.innerHTML = "Cliquez ici pour importer votre logo";
  } else {
    labelNon.classList.add("btn_validate");
    labelOui.classList.remove("btn_validate");
    importLabel.innerHTML = "Cliquez ici pour modifier votre logo";
    importLabel.classList.remove("btn_validate");
    logo_file.value = null;
  }
}

////// Couleurs
function showColorFields() {
  var nombreCouleurs = document.getElementById("nombre-couleurs").value;

  // Affiche les champs de couleur et les labels en fonction du nombre sélectionné
  for (var i = 1; i <= 3; i++) {
    var couleurField = document.getElementById("couleur" + i);
    var couleurLabel = document.getElementById("label-couleur" + i);

    if (i <= nombreCouleurs) {
      couleurField.style.display = "unset";
      couleurLabel.style.display = "unset";
    } else {
      couleurField.style.display = "none";
      couleurLabel.style.display = "none";
    }
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
