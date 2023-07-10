<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
?>

<h1>Suite du formualire de création de site</h1>
<h2>Entrez les différentes informations pour un site plus personnel</h2>


<?php
session_start();
require_once ROOT . 'App/Model.php';

echo "<p>Bienvenue " . $_SESSION['nom'] . " " . $_SESSION['prenom'] . " Vous avez un projet de site internet ? Renseignez vos informations nous nous occupons du reste.</p>";
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="form-group">
                    <label for="pet-select" style="display: block;">Type de site</label>
                    <select name="type_site" id="type_site" class="form-control">
                        <option value="">Choisissez une option</option>
                        <option value="vitrine">Site Vitrine</option>
                        <option value="e-commerce">E-commerce</option>
                        <option value="portfolio">Portfolio</option>
                        <option value="annnonce">Site d'annonce</option>
                        <option value="association">Site pour association</option>
                        <option value="agence-immo">Site pour agence immobilière</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombre-couleurs" style="display: block;">Combien de couleurs sur votre site ? (1 à 3 max)</label>
                    <input type="number" name="nombre-couleurs" id="nombre-couleurs" min="1" max="3" class="form-control">
                </div>
                <div class="form-group">
                    <label for="couleur1" style="display: block;">Choisissez votre couleur principale</label>
                    <input type="color" name="couleur1" id="couleur1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="couleur2" style="display: block;">Choisissez votre couleur secondaire</label>
                    <input type="color" name="couleur2" id="couleur2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="couleur3" style="display: block;">Choisissez votre couleur tertiaire</label>
                    <input type="color" name="couleur3" id="couleur3" class="form-control">
                </div>
            </form>
        </div>
    </div>
</div>