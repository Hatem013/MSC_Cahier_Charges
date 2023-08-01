////////////////// Fonction globale ////////////////

function Show(name) {
  name.classList.remove("d-none");
}

function Hide(name) {
  name.classList.add("d-none");
}

function GetElement(id) {
  return document.getElementById(id);
}

//// Evenements sur le formulaire
const formulaires = [
  GetElement("formulaire1"),
  GetElement("formulaire2"),
  GetElement("formulaire3"),
  GetElement("formulaire4"),
];

const formulaires_btn = [
  GetElement("formulaire1_btn"),
  GetElement("formulaire2_btn"),
  GetElement("formulaire3_btn"),
  GetElement("formulaire4_btn")
];

let next_number = null;
let completed_form = null;
let next_form = null;

// On automatise l'affichage des prochain formulaire en fonction du nombre de formulaires dans la const

formulaires_btn.forEach((button) =>
  button.addEventListener("click", showNextForm)
);

function showNextForm() {
  // On récupere l'id du bouton du formulaire en cours
  let name = this.id.slice(0, 10);
  let number = this.id.slice(10, 11);

  // On récupere le formulaire en cours grâce à l'id du bouton
  completed_form = GetElement(name + number);

  // Recupere tout les input du formulaire en cours
  let completed_form_input = completed_form.getElementsByTagName("input");

  // Recupere l'id du prochain formulaire
  next_number = parseInt(number) + 1;
  next_form = GetElement(name + next_number);


  var input = [];
  var filled = null;

  for (let i = 0; i <= completed_form_input.length - 1; i++) {
   input.push(completed_form_input[i].reportValidity())
  };

  let check = arr => arr.every(v => v === true);
  
  if(check(input)) {
    filled = true
  } else {
    filled = false
  }

  
  
  // Si tous les champs sont remplis alors on active le script
  if (filled === true) {
    // On verifie si le formulaire suivant existe, s'il existe on affiche le formulaire suivant, et s'il n'existe pas on affiche le bouton d'envoie du formulaire
    gotoNext();
  } 


  // Dans le cas où on n'a pas de logo à importer (obligé de faire un script exprès car l'automatisation plus haut interfère)
  if (filled === false && completed_form == GetElement("formulaire2")) {
    if (
      completed_form_input[0].value !== "0" &&
      completed_form_input[1].value !== "" &&
      GetElement("message_ent").value !== ""
    ) {
      if (
        labelNon.classList.contains("btn_validate") &&
        GetElement("type_site").value !== ""
      ) {
        gotoNext();
      }
    }
  }
  
}

function gotoNext() {
  if (next_number <= formulaires.length) {
    Hide(completed_form);
    Show(next_form);

    // On affiche le recap
  } else {
    setTimeout(() => {
      window.scrollTo(0, 0);
    }, 230);

    formulaires_btn.forEach((button) => Hide(button));
    formulaires.forEach((form) => Show(form));

    Show(document.getElementById("form_btn"));
  }
}
