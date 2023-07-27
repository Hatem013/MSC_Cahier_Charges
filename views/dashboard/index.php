<?php
include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
require_once ROOT . 'App/Model.php';
session_start();

// Fonction pour déconnecter l'utilisateur
function deconnexion() {
    // Supprimer toutes les variables de session
    session_unset();

    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion (ou toute autre page appropriée)
    header("Location: http://localhost/MSC-1/login");
    exit();
}

// Vérifier si l'utilisateur est connecté avant d'afficher le contenu de la page
if (!isset($_SESSION['client_id']) || !isset($_SESSION['pseudo'])) {
    // Rediriger vers la page de connexion (ou toute autre page appropriée)
    header("Location: http://localhost/MSC-1/login");
    exit();
}

// Vérifier si le bouton de déconnexion a été cliqué
if (isset($_POST['logout'])) {
    deconnexion();
}
?>

<div class="container mt-5">
    <h1 class="text-center">Bienvenue <?php echo htmlspecialchars($_SESSION['pseudo']); ?></h1>

    <div class="row mt-5">
        <!-- Bouton "Créer site" -->
        <div class="col-md-4">
            <button class="btn btn-primary btn-block"> <a href="http://localhost/MSC-1/client1"> Créer site</a></button>
        </div>
        <!-- Bouton "Voir mon site" -->
        <div class="col-md-4">
            <button class="btn btn-primary btn-block">Voir mon site</button>
        </div>
        <!-- Bouton "Avancé de mon site" -->
        <div class="col-md-4">
            <button class="btn btn-primary btn-block">Avancé de mon site</button>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Bouton "Modifier site" -->
        <div class="col-md-4">
            <button class="btn btn-primary btn-block">Modifier site</button>
        </div>
        <!-- Bouton "Contacter développeur" -->
        <div class="col-md-4">
            <button class="btn btn-primary btn-block">Contacter développeur</button>
        </div>
        <!-- Bouton "Voir les sites exemples" -->
        <div class="col-md-4">
            <button class="btn btn-primary btn-block">Voir les sites exemples</button>
        </div>
    </div>

    <!-- Bouton "Déconnexion" -->
    <form method="post" class="mt-5 text-center" action="">
        <button type="submit" name="logout" class="btn btn-danger">Déconnexion</button>
    </form>
</div>