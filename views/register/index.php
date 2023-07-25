<?php
session_start();
// Inclure les fichiers nécessaires ici (header, footer, etc.)
include_once ROOT . '/views/home/header.php';
include_once ROOT . '/views/home/footer.php';
require_once ROOT . '/App/Model.php'; // Assurez-vous que le chemin vers Model.php est correct

class ClientModel extends Model
{
    public function insertClient($nom, $prenom, $pseudo, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO clients (nom, prenom, pseudo, email, mot_de_passe) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$nom, $prenom, $pseudo, $email, $hashedPassword]);
    }
}

function validateForm($formData)
{
    $errors = [];

    // Validation et échappement des données utilisateur pour prévenir les attaques XSS
    $nom = htmlspecialchars(trim($formData['nom']));
    $prenom = htmlspecialchars(trim($formData['prenom']));
    $pseudo = htmlspecialchars(trim($formData['pseudo']));
    $email = htmlspecialchars(trim($formData['email']));
    $password = trim($formData['password']);

    if (empty($nom)) {
        $errors['nom'] = 'Le champ nom est requis.';
    }

    if (empty($prenom)) {
        $errors['prenom'] = 'Le champ prénom est requis.';
    }

    if (empty($pseudo)) {
        $errors['pseudo'] = 'Le champ pseudo est requis.';
    }

    // Validation de l'email avec filter_var
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Veuillez entrer une adresse email valide.';
    }

    if (empty($password)) {
        $errors['password'] = 'Le champ mot de passe est requis.';
    }

    // Vous pouvez ajouter d'autres validations ici selon vos besoins

    return ['nom' => $nom, 'prenom' => $prenom, 'pseudo' => $pseudo, 'email' => $email, 'password' => $password, 'errors' => $errors];
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les données du formulaire
    $formData = validateForm($_POST);

    // S'il n'y a pas d'erreurs de validation, enregistrer les données dans la base de données
    if (empty($formData['errors'])) {
        $clientModel = new ClientModel();
        $clientModel->getConnexion(); // Assurez-vous que la méthode getConnexion() se connecte à la base de données
        $clientModel->insertClient($formData['nom'], $formData['prenom'], $formData['pseudo'], $formData['email'], $formData['password']);

        $_SESSION['nom'] = $formData['nom'];
        $_SESSION['prenom'] = $formData['prenom'];
        $_SESSION['pseudo'] = $formData['pseudo'];
        $_SESSION['email'] = $formData['email'];

        // Redirection vers le dashboard
        header("Location: http://localhost/MSC-1/dashboard");
        exit();
    }
}
?>

<div class="container formulaire">
    <form class="mx-auto text-center" method="post">
        <div class="mb-5 form-group">
            <label for="nom">Nom</label><br>
            <input type="text" class="form-control" name="nom" id="nom">
            <?php if (isset($formData['errors']['nom'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['nom']; ?></span>
            <?php } ?>
        </div>
        <div class="mb-5 form-group">
            <label for="prenom">Prénom</label><br>
            <input type="text" class="form-control" name="prenom" id="prenom">
            <?php if (isset($formData['errors']['prenom'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['prenom']; ?></span>
            <?php } ?>
        </div>
        <div class="mb-5 form-group">
            <label for="pseudo">Pseudo</label><br>
            <input type="text" class="form-control" name="pseudo" id="pseudo">
            <?php if (isset($formData['errors']['pseudo'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['pseudo']; ?></span>
            <?php } ?>
        </div>
        <div class="mb-5 form-group">
            <label for="email">Email</label><br>
            <input type="email" class="form-control" name="email" id="email">
            <?php if (isset($formData['errors']['email'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['email']; ?></span>
            <?php } ?>
        </div>
        <div class="mb-5 form-group">
            <label for="password">Mot de passe</label><br>
            <input type="password" class="form-control" name="password" id="password">
            <?php if (isset($formData['errors']['password'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['password']; ?></span>
            <?php } ?>
        </div>
        <div class="row p-2">
            <button type="submit" class="btn my-3">Créer un compte</button>
        </div>
    </form>
</div>