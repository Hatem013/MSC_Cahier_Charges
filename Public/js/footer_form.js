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

class Footer {
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

const footer_desktop = new Footer(
  GetElement("footer_desktop_btn"),
  document.querySelectorAll(".collapse")[3],
  document.querySelectorAll(".footer_input "),
  document.querySelectorAll(".footerTaille "),
  GetElement("footer_desktop_selection_display"),
  GetElement("footer_desktop_preview"),
  GetElement("footer_desktop_preview_img"),
  GetElement("footer_desktop_div")
);

const footer_mobile = new Footer(
  GetElement("footer_mobile_btn"),
  document.querySelectorAll(".collapse")[4],
  document.querySelectorAll(".footer_mobile_input "),
  document.querySelectorAll(".footerMobileTaille "),
  GetElement("footer_mobile_selection_display"),
  GetElement("footer_mobile_preview"),
  GetElement("footer_mobile_preview_img"),
  GetElement("footer_mobile_div")
);

/////////////// Desktop ///////////////

// Boucle desktop

footer_desktop.input_div.forEach((input) =>
  input.addEventListener("click", selectFooterDesktop)
);

// Selectionne l'input
function selectFooterDesktop() {
  if (!footer_desktop.button.classList.contains("btn_validate")) {
    // Bouton de validation
    Validate(footer_desktop.button);
    Text(footer_desktop.button, "Cliquez ici pour modifier votre choix");

    // Affiche la div
    Show(footer_mobile.div);

    // Affichage du preview
    Hide(footer_desktop.menu);
    new bootstrap.Collapse(footer_desktop.collapse);
    Show(footer_desktop.preview_div);
    Show(footer_mobile.menu);

    // Trigger bootstrap mobile
    new bootstrap.Collapse(footer_mobile.collapse);

    setTimeout(() => {
      window.scrollTo(0, 250);
    }, 230);

    /// Sinon trigger juste le collapse
  } else {
    new bootstrap.Collapse(footer_desktop.collapse);
  }

  // Affiche la preview
  footer_desktop.preview_img.src = this.src;
  Hide(footer_desktop.menu);
  Show(footer_desktop.preview_div);
}

// Afficher le menu desktop
function desktopFooterMenuDisplay() {
  // On vérifie d'abord si une selection a été faite via la valeur de l'input
  var selected = document.querySelector('input[name="footer"]:checked');

  // Si aucune selection n'a été faite auparavant, affiche le menu de selection
  if (selected == null) {
    Show(footer_desktop.menu);
    footer_desktop.menu.classList.remove("show");
    new bootstrap.Collapse(footer_desktop.collapse);

    // Si une selection a été faite auparavant, cacher la preview jusqu'à qu'une nouvelle selection soit faite
  } else {
    Show(footer_desktop.menu);
    Hide(footer_desktop.preview_div);
    new bootstrap.Collapse(footer_desktop.collapse);
  }
}

/////////////// Mobile ///////////////

// Boucle mobile
footer_mobile.input_div.forEach((input) =>
  input.addEventListener("click", selectMobileFooter)
);

// Selectionne l'input
function selectMobileFooter() {
  if (!footer_mobile.button.classList.contains("btn_validate")) {
    Validate(footer_mobile.button);
    Text(footer_mobile.button, "Cliquez ici pour modifier votre choix");

    // Trigger bootstrap
    new bootstrap.Collapse(footer_mobile.collapse);
    setTimeout(() => {
      window.scrollTo(0, 250);
    }, 230);
  } else {
    new bootstrap.Collapse(footer_mobile.collapse);
  }

  // Affiche la preview
  Hide(footer_mobile.menu);
  Show(footer_mobile.preview_div);
  footer_mobile.preview_img.src = this.src;
}

// Afficher le menu desktop
function mobileFooterMenuDisplay() {
  // On vérifie d'abord si une selection a été faite via la valeur de l'input
  var selected = document.querySelector('input[name="footer_mobile"]:checked');

  // Si aucune selection n'a été faite auparavant, affiche le menu de selection
  if (selected == null) {
    Show(footer_mobile.menu);
    new bootstrap.Collapse(footer_mobile.collapse);

    // Si une selection a été faite auparavant, cacher la preview jusqu'à qu'une nouvelle selection soit faite
  } else {
    Show(footer_mobile.menu);
    Hide(footer_mobile.preview_div);
    new bootstrap.Collapse(footer_mobile.collapse);
  }
}

/////////////// Mouseover trigger scale up and down ///////////////
function mouseoverScale() {
  this.style.transform = "scale(1.2)";

  this.addEventListener("mouseout", () => {
    this.style.transform = "scale(1)";
  });
}
