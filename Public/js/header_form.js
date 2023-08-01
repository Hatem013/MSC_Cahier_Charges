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

function Text(name, text) {
  name.innerHTML = text;
}

function GetElement(id) {
  return document.getElementById(id);
}

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
  GetElement("header_desktop_btn"),
  document.querySelectorAll(".collapse")[1],
  document.querySelectorAll(".header_input "),
  document.querySelectorAll(".headerTaille "),
  GetElement("header_desktop_selection_display"),
  GetElement("header_desktop_preview"),
  GetElement("header_desktop_preview_img"),
  GetElement("header_desktop_div")
);

const header_mobile = new Header(
  GetElement("header_mobile_btn"),
  document.querySelectorAll(".collapse")[2],
  document.querySelectorAll(".header_mobile_input "),
  document.querySelectorAll(".headerMobileTaille "),
  GetElement("header_mobile_selection_display"),
  GetElement("header_mobile_preview"),
  GetElement("header_mobile_preview_img"),
  GetElement("header_mobile_div")
);

/////////////// Desktop ///////////////

// Boucle desktop

header_desktop.input_div.forEach((input) =>
  input.addEventListener("click", selectHeaderDesktop)
);

// Selectionne l'input
function selectHeaderDesktop() {
  if (!header_desktop.button.classList.contains("btn_validate")) {
    // Bouton de validation
    Validate(header_desktop.button);
    Text(header_desktop.button, "Cliquez ici pour modifier votre choix");

    // Affiche la div
    Show(header_mobile.div);

    // Affichage du preview
    Hide(header_desktop.menu);
    new bootstrap.Collapse(header_desktop.collapse);
    Show(header_desktop.preview_div);
    Show(header_mobile.menu);

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
  Hide(header_desktop.menu);
  Show(header_desktop.preview_div);
}

// Afficher le menu desktop
function desktopMenuDisplay() {
  // On vérifie d'abord si une selection a été faite via la valeur de l'input
  var selected = document.querySelector('input[name="header"]:checked');

  // Si aucune selection n'a été faite auparavant, affiche le menu de selection
  if (selected == null) {
    Show(header_desktop.menu);
    header_desktop.menu.classList.remove("show");
    new bootstrap.Collapse(header_desktop.collapse);

    // Si une selection a été faite auparavant, cacher la preview jusqu'à qu'une nouvelle selection soit faite
  } else {
    Show(header_desktop.menu);
    Hide(header_desktop.preview_div);
    new bootstrap.Collapse(header_desktop.collapse);
  }
}

/////////////// Mobile ///////////////

// Boucle mobile
header_mobile.input_div.forEach((input) =>
  input.addEventListener("click", selectMobileHeader)
);

// Selectionne l'input
function selectMobileHeader() {
  if (!header_mobile.button.classList.contains("btn_validate")) {
    Validate(header_mobile.button);
    Text(header_mobile.button, "Cliquez ici pour modifier votre choix");

    // Trigger bootstrap
    new bootstrap.Collapse(header_mobile.collapse);
    setTimeout(() => {
      window.scrollTo(0, 250);
    }, 230);
  } else {
    new bootstrap.Collapse(header_mobile.collapse);
  }

  // Affiche la preview
  Hide(header_mobile.menu);
  Show(header_mobile.preview_div);
  header_mobile.preview_img.src = this.src;
}

// Afficher le menu desktop
function mobileMenuDisplay() {
  // On vérifie d'abord si une selection a été faite via la valeur de l'input
  var selected = document.querySelector('input[name="header_mobile"]:checked');

  // Si aucune selection n'a été faite auparavant, affiche le menu de selection
  if (selected == null) {
    Show(header_mobile.menu);
    new bootstrap.Collapse(header_mobile.collapse);

    // Si une selection a été faite auparavant, cacher la preview jusqu'à qu'une nouvelle selection soit faite
  } else {
    Show(header_mobile.menu);
    Hide(header_mobile.preview_div);
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
