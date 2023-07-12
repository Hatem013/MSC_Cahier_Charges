<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
?>

<div class="container text-center">
<h1>Suite du formualire de création de site</h1>
<h2>Entrez les différentes informations pour un site plus personnel</h2>
</div>

<?php
session_start();
require_once ROOT . '/App/Model.php';
?>

<script>
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
</script>

<?php
echo "<p>Bienvenue " . $_SESSION['nom'] . " " . $_SESSION['prenom'] . " Vous avez un projet de site internet ? Renseignez vos informations nous nous occupons du reste.</p>";
?>
<div class="container formulaire">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="form-group">
                    <label for="nombre-couleurs">Combien de couleurs sur votre site ? (1 à 3 max)</label>
                    <input type="number" name="nombre-couleurs" id="nombre-couleurs" min="1" max="3" oninput="showColorFields()">
                </div>

                <?php for ($i = 1; $i <= 3; $i++) { ?>
                    <div class="form-group" id="label-couleur<?php echo $i; ?>" style="display: none;">
                        <label for="couleur<?php echo $i; ?>">Choisissez votre couleur <?php echo ($i == 1) ? 'principale' : (($i == 2) ? 'secondaire' : 'tertiaire'); ?></label>
                    </div>
                    <div class="form-group">
                        <input type="color" name="couleur<?php echo $i; ?>" id="couleur<?php echo $i; ?>" style="display: none;">
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="logo">Avez-vous un logo ?</label>
                    <input type="radio" name="logo" id="logo_oui" value="oui" onclick="showLogoFields()">
                    <label for="logo_oui">Oui</label>
                    <input type="radio" name="logo" id="logo_non" value="non" onclick="showLogoFields()">
                    <label for="logo_non">Non</label>
                </div>

                <div id="logo-file-field" style="display: none;">
                    <div class="form-group">
                        <label for="logo-file">Sélectionnez votre logo</label>
                        <input type="file" name="logo-file" id="logo-file">
                    </div>
                </div>

                <div id="create-logo-field" style="display: none;">
                    <div class="form-group">
                        <label for="create-logo">Souhaitez-vous que nous vous créions un logo ?</label>
                        <input type="radio" name="create-logo" id="create-logo_oui" value="oui">
                        <label for="create-logo_oui">Oui</label>
                        <input type="radio" name="create-logo" id="create-logo_non" value="non">
                        <label for="create-logo_non">Non</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

