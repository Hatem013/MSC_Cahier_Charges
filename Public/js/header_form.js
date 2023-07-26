class Header {
  constructor(
    button,
    collapse,
    input,
    input_div,
    menu,
    preview_div,
    preview_img,
    div
  ) {
    this.button = button;
    this.collapse = collapse;
    this.input = input;
    this.input_div = input_div;
    this.menu = menu;
    this.preview_div = preview_div;
    this.preview_img = preview_img;
    this.div = div;
  }
}

const header_desktop = new Header(
  document.getElementById("header_desktop_btn"),
  document.querySelectorAll(".collapse")[1],
  document.querySelectorAll(".header_input "),
  document.querySelectorAll(".headerTaille "),
  document.getElementById("header_desktop_selection_display"),
  document.getElementById("header_desktop_preview"),
  document.getElementById("header_desktop_preview_img"),
  document.getElementById("header_desktop_div")
);

const header_mobile = new Header(
  document.getElementById("header_mobile_btn"),
  document.querySelectorAll(".collapse")[2],
  document.querySelectorAll(".header_mobile_input "),
  document.querySelectorAll(".headerMobileTaille "),
  document.getElementById("header_mobile_selection_display"),
  document.getElementById("header_mobile_preview"),
  document.getElementById("header_mobile_preview_img"),
  document.getElementById("header_mobile_div")
);

/////////////// Desktop ///////////////

// Boucle desktop
for (var i = 0; i < header_desktop.input_div.length; i++) {
  header_desktop.input_div[i].addEventListener("mouseover", mouseoverScale);
  header_desktop.input_div[i].addEventListener("click", selectHeaderDesktop);
}

// Selectionne l'input
function selectHeaderDesktop() {
  if (!header_desktop.button.classList.contains("btn_validate")) {
    // Bouton de validation
    header_desktop.button.classList.add("btn_validate");
    header_desktop.button.innerHTML = "Cliquez ici pour modifier votre choix";

    // Affiche la div
    header_mobile.div.classList.remove("d-none");

    // Affichage du preview
    header_desktop.menu.classList.add("d-none");
    new bootstrap.Collapse(header_desktop.collapse);
    header_desktop.preview_div.classList.remove("d-none");
    header_mobile.menu.classList.remove("d-none");

    // Trigger bootstrap mobile
    new bootstrap.Collapse(header_mobile.collapse);

    setTimeout(() => {
      window.scrollTo(0, 250);
    }, 230);

    /// Sinon trigger juste le collapse
  } else {
    new bootstrap.Collapse(header_desktop.collapse);
  }

  // Affiche la preview
  header_desktop.preview_img.src = this.src;
  header_desktop.menu.classList.add("d-none");
  header_desktop.preview_div.classList.remove("d-none");
 
}

// Afficher le menu desktop
function desktopMenuDisplay() {
  // On vérifie d'abord si une selection a été faite via la valeur de l'input
  var selected = document.querySelector('input[name="header"]:checked');

  // Si aucune selection n'a été faite auparavant, affiche le menu de selection
  if (selected == null) {
    header_desktop.menu.classList.remove("d-none");
    header_desktop.menu.classList.remove("show");
    new bootstrap.Collapse(header_desktop.collapse);

    // Si une selection a été faite auparavant, cacher la preview jusqu'à qu'une nouvelle selection soit faite
  } else {
    header_desktop.menu.classList.remove("d-none");
    header_desktop.preview_div.classList.add("d-none");
    new bootstrap.Collapse(header_desktop.collapse);
  }
}

/////////////// Mobile ///////////////

// Boucle mobile
for (var i = 0; i < header_mobile.input_div.length; i++) {
  header_mobile.input_div[i].addEventListener("mouseover", mouseoverScale);
  header_mobile.input_div[i].addEventListener("click", selectMobileHeader);

}

// Selectionne l'input
function selectMobileHeader() {


  if (!header_mobile.button.classList.contains("btn_validate")) {
    header_mobile.button.classList.add("btn_validate");
    header_mobile.button.innerHTML = "Cliquez ici pour modifier votre choix";

    // Trigger bootstrap
    new bootstrap.Collapse(header_mobile.collapse);
    setTimeout(() => {
      window.scrollTo(0, 250);
    }, 230);

    
  } else {
    new bootstrap.Collapse(header_mobile.collapse);
  }

  // Affiche la preview
  header_mobile.menu.classList.add("d-none");
  header_mobile.preview_div.classList.remove("d-none");
  header_mobile.preview_img.src = this.src;
}

// Afficher le menu desktop
function mobileMenuDisplay() {

  // On vérifie d'abord si une selection a été faite via la valeur de l'input
  var selected = document.querySelector('input[name="header_mobile"]:checked');

  // Si aucune selection n'a été faite auparavant, affiche le menu de selection
  if (selected == null) {
    header_mobile.menu.classList.remove("d-none");
    new bootstrap.Collapse(header_mobile.collapse);

  // Si une selection a été faite auparavant, cacher la preview jusqu'à qu'une nouvelle selection soit faite
  } else {
    header_mobile.menu.classList.remove("d-none");
    header_mobile.preview_div.classList.add("d-none");
    new bootstrap.Collapse(header_mobile.collapse);
  }
}


/////////////// Mouseover trigger scale up and down ///////////////
function mouseoverScale() {
  this.style.transform = "scale(1.2)";

  this.addEventListener("mouseout", () => {
    this.style.transform = "scale(1)";
  });
}
