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

  // Affiche le champ de fichier si "Oui" est sélectionné, sinon affiche le champ de création de logo
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

function showLogoPreview() {
  logo_file.onchange = (evt) => {
    const [file] = logo_file.files;
    if (file) {
      blah.src = URL.createObjectURL(file);
    }
  };
}
/*
// color picker
var test1 = document.getElementById("couleur" + 1);
var test2 = document.getElementById("label-couleur" + 1);
var test3 = document.getElementById("lblclr");

test1.addEventListener("change", testing);

function testing() {
  test3.style.backgroundColor = test1.value;
}
*/
