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

for (let i = 0; i <= formulaires_btn.length; i++) {
  formulaires_btn[i].addEventListener("click", showNextForm);
}

function showNextForm() {
  var name = this.id.slice(0, 10);
  var number = this.id.slice(10, 11);
  var next_number = parseInt(number) + 1;
  var completed_form = document.getElementById(name + number);
  var next_form = document.getElementById(name + next_number);

  completed_form.classList.add("d-none");

  if (next_number <= formulaires.length) {
      next_form.classList.remove("d-none");

  } else {
    document.getElementById("form_btn").classList.remove("d-none");
  }

}

