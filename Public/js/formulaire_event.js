////////////////// Fonction globale ////////////////

function Show(name) {
  name.classList.remove("d-none");
}

function Hide(name) {
  name.classList.add("d-none");
}

//// Evenements sur le formulaire
const formulaires = [
  document.getElementById("formulaire1"),
  document.getElementById("formulaire2"),
  document.getElementById("formulaire3"),
  document.getElementById("formulaire4"),
  document.getElementById("formulaire5"),
];

const formulaires_btn = [
  document.getElementById("formulaire1_btn"),
  document.getElementById("formulaire2_btn"),
  document.getElementById("formulaire3_btn"),
  document.getElementById("formulaire4_btn"),
  document.getElementById("formulaire5_btn"),
];

// On automatise l'affichage des prochain formulaire en fonction du nombre de formulaires dans la const

formulaires_btn.forEach((button) =>
  button.addEventListener("click", showNextForm)
);

function showNextForm() {
  // On récupere l'id du bouton du formulaire en cours
  let name = this.id.slice(0, 10);
  let number = this.id.slice(10, 11);

  // On récupere le formulaire en cours grâce à l'id du bouton
  let completed_form = document.getElementById(name + number);

  // Recupere tout les input du formulaire en cours
  let completed_form_input = completed_form.getElementsByTagName("input");

  // Recupere l'id du prochain formulaire
  let next_number = parseInt(number) + 1;
  let next_form = document.getElementById(name + next_number);

  // Vérifie si tous les champs sont remplis dans le formulaire en cours, et on renvoie un booléen
  for (let i = 0; i <= completed_form_input.length - 1; i++) {
    if (!completed_form_input[i].value == "") {
      var filled = true;
    } else {
      var filled = false;
    }
  }

  // Si tous les champs sont remplis alors on active le script
  if (filled === true) {
    // On verifie si le formulaire suivant existe, s'il existe on affiche le formulaire suivant, et s'il n'existe pas on affiche le bouton d'envoie du formulaire
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

    // Sinon ...
  } else {
    console.log("non");
  }
}
