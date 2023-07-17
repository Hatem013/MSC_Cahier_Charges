function showColorFields() {
    var nombreCouleurs = document.getElementById('nombre-couleurs').value;

    // Affiche les champs de couleur et les labels en fonction du nombre sélectionné
    for (var i = 1; i <= 3; i++) {
        var couleurField = document.getElementById('couleur' + i);
        var couleurLabel = document.getElementById('label-couleur' + i);

        if (i <= nombreCouleurs) {
            couleurField.style.display = 'block';
            couleurLabel.style.display = 'block';
        } else {
            couleurField.style.display = 'none';
            couleurLabel.style.display = 'none';
        }
    }
}
function showLogoFields() {
    var logoOui = document.getElementById('logo_oui');
    var logoNon = document.getElementById('logo_non');
    var logoFileField = document.getElementById('logo-file-field');
    var createLogoField = document.getElementById('create-logo-field');

    // Affiche le champ de fichier si "Oui" est sélectionné, sinon affiche le champ de création de logo
    if (logoOui.checked) {
        logoFileField.style.display = 'block';
        createLogoField.style.display = 'none';
    } else if (logoNon.checked) {
        logoFileField.style.display = 'none';
        createLogoField.style.display = 'block';
    }
}