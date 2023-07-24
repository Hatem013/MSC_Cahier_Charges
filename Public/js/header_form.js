// Bouton de selection
var header_desktop_btn = document.getElementById("header_desktop_btn");
var header_mobile_btn = document.getElementById("header_mobile_btn");

// Collapse bootstrap
var header_desktop_collapse = document.querySelectorAll(".collapse")[1];
var header_mobile_collapse = document.querySelectorAll(".collapse")[2];

// Input desktop + mobile
var header_desktop_input = document.querySelectorAll(".headerTaille ");
var header_mobile_input = document.querySelectorAll(".headerMobileTaille ");

//  Div header mobile
var header_mobile_div = document.getElementById("header_mobile_div");

// Menu de selection
var header_desktop_menu = document.getElementById("header_selection_display");

// Preview
var header_desktop_preview = document.getElementById("header_preview");

///// Action de validation du choix des headers

//// Script desktop

// Afficher la preview
function desktopPreview() {

  // Cache le menu de selection, affiche la preview
  document.getElementById("header_selection_display").classList.add("d-none")
  document.getElementById("header_preview").classList.remove("d-none");

  // Redirige la valeur de l'input vers l'image
  var selected = document.querySelector('input[name="header"]:checked');
  var preview = document.getElementById("header_preview_img");
 
  preview.src = selected.value;
  
}

// Afficher le menu desktop
function desktopMenuDisplay() {

  // On vérifie d'abord si une selection a été faite via la valeur de l'input
  var selected = document.querySelector('input[name="header"]:checked');
  
  // Si aucune selection n'a été faite auparavant, affiche le menu de selection
  if (selected == null) {
    new bootstrap.Collapse(header_desktop_collapse);
    document.getElementById("header_selection_display").classList.remove("d-none")

    // Si une selection a été faite auparavant, cacher la preview jusqu'à qu'une nouvelle selection soit faite
  } else {
  
    document.getElementById("header_selection_display").classList.remove("d-none");
    document.getElementById("header_preview").classList.add("d-none");
  }
}


for (var i = 0; i < header_desktop_input.length; i++) {
  header_desktop_input[i].addEventListener("click", selectHeaderDesktop);
}

function selectHeaderDesktop() {
  if (!header_desktop_btn.classList.contains("btn_validate")) {
    
    // Bouton de validation
    header_desktop_btn.classList.add("btn_validate");
    header_desktop_btn.innerHTML =
      "Modifier votre choix de header version ordinateur";

    // Affichage du preview
     header_desktop_menu.classList.add("d-none");
    header_desktop_preview.classList.remove("d-none");
      
      
      // Trigger bootstrap
    new bootstrap.Collapse(header_desktop_collapse);
    new bootstrap.Collapse(header_mobile_collapse);

    // Affiche le prochain bouton
    header_mobile_div.classList.remove("d-none");
  
    /// Sinon trigger juste le collapse
  } else {
    new bootstrap.Collapse(header_desktop_collapse);
  }
}



//// Script mobile
for (var i = 0; i < header_mobile_input.length; i++) {
  header_mobile_input[i].addEventListener("click", selectMobileHeader);
}

function selectMobileHeader() {
  if (!header_mobile_btn.classList.contains("btn_validate")) {
    header_mobile_btn.classList.add("btn_validate");
    header_mobile_btn.innerHTML =
      "Modifier votre choix de header version mobile et tablette";

    // Trigger bootstrap
    new bootstrap.Collapse(header_mobile_collapse);
  } else {
    new bootstrap.Collapse(header_mobile_collapse);
  }
}
