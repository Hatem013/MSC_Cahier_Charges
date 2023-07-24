

// Selection oui ou non du logo

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

////// Client3 header
