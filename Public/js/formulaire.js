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

