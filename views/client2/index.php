<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
?>

<h1>Suite du formualire de création de site</h1>
<h2>Entrez les différentes informations pour un site plus personnel</h2>


<?php
session_start();
require_once ROOT . 'App/Model.php';

echo"<p>Bienvenue ". $_SESSION['nom'] . " " . $_SESSION['prenom'] . " Vous avez un projet de site internet ? Renseignez vos informations nous nous occupons du reste.</p>";


