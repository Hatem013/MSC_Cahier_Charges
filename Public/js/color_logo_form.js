
////////////////// Fonction globale ////////////////

function Show(name) {
  name.classList.remove("d-none");
}

function Hide(name) {
  name.classList.add("d-none");
}

function Validate(name) {
  name.classList.add("btn_validate");
}

function Unvalidate(name) {
  name.classList.remove("btn_validate");
}

////////////////// Logo //////////////////

const logoOui = document.getElementById("logo_oui");
const labelOui = document.getElementById("logo_label_oui");
const logoNon = document.getElementById("logo_non");
const labelNon = document.getElementById("logo_label_non");
const logoFileField = document.getElementById("logo_file_field");
const alertLogoField = document.getElementById("logo_alert_field");
const logoFilePreview = document.getElementById("logo_file_preview");
const logoFile = document.getElementById("logo_file");
const importLabel = document.getElementById("logo_import_label");

// Affiche la preview si "Oui" est sélectionné, sinon affiche le message
function showLogoFields() {
  
  // On vérifie quel bouton a été sélectionné
  if (logoOui.checked) {
    
    // Si on a un logo, on affiche l'input file et on le passe en required
    Show(logoFileField);
    logoFile.required = true;

    // On cache le message d'alerte
    Hide(alertLogoField);

    // On valide le bouton et invalide l'autre
    Validate(labelOui);
    Unvalidate(labelNon); 


    // Si on n'a pas de logo, on cache l'input file et on le passe en non required
  } else if (logoNon.checked) {
    Hide(logoFileField);
    Hide(logoFilePreview);

    logoFile.required = false;

    // On affiche le message d'alerte
    Show(alertLogoField);

    // On valide le bouton et invalide les deux autres
    Validate(labelNon);
    Unvalidate(labelOui);
    Unvalidate(importLabel);

    // On update le label du bouton import 
    importLabel.innerHTML = "Cliquez ici pour importer votre logo";

    // On vide l'input file de tout import 
    logo_file.value = null;
  }
}

// S'il n'y a pas de fichier, on cache la div preview
if (logoFile.files.length == 0) {
  Hide(logoFilePreview);
}

// Lorsqu'on insère un fichier, on affiche la div preview et on redirige l'src du fichier vers l'src de la preview;
logoFile.addEventListener("change", () => {
  const [file] = logoFile.files
  if (file) {
      logoFilePreview.src = URL.createObjectURL(file)
      Show(logoFilePreview)
  }
  // Puis on change le label du logo.
  importLabel.innerHTML = "Cliquez ici pour modifier votre logo";
  Validate(importLabel);
  Show(importLabel);

})


////// Couleurs
function showColorFields() {
  var nombreCouleurs = document.getElementById("nombre-couleurs").value;

  // Affiche les champs de couleur et les labels en fonction du nombre sélectionné
  for (var i = 1; i <= 3; i++) {
    const couleurField = document.getElementById("couleur" + i);
    const couleurLabel = document.getElementById("label_couleur_div" + i);

    if (i <= nombreCouleurs) {
      Show(couleurField);
      Show(couleurLabel);
    } else {
      Hide(couleurField);
      Hide(couleurLabel);
    }
  }
}

const couleurField = [
  document.getElementById("couleur1"),
  document.getElementById("couleur2"),
  document.getElementById("couleur3"),
];

const couleurLabel = [
  document.getElementById("label_couleur1"),
  document.getElementById("label_couleur2"),
  document.getElementById("label_couleur3"),
];


// On change le background des label en fonction de la couleur séléctionnée

couleurField[0].addEventListener("change", () => {
  couleurLabel[0].style.backgroundColor = couleurField[0].value;
});
couleurField[1].addEventListener("change", () => {
  couleurLabel[1].style.backgroundColor = couleurField[1].value;
});
couleurField[2].addEventListener("change", () => {
  couleurLabel[2].style.backgroundColor = couleurField[2].value;
});
