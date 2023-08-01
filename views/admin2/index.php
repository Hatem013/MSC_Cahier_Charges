<?php
session_start();

include_once ROOT . '/views/home/header.php';
include_once ROOT . '/views/home/footer.php';
require_once ROOT . '/App/Model.php'; 

class AdminModel extends Model
{
    public function insertAdmin($nom, $prenom, $email, $pseudo, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO administrateurs (nom, prenom, email, pseudo, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $pseudo, $hashedPassword]);
        return $this->connexion->lastInsertId();
    }
}

function validateForm($formData)
{
    $errors = [];

    // Validation et échappement des données utilisateur pour prévenir les attaques XSS
    $nom = htmlspecialchars(trim($formData['nom']));
    $prenom = htmlspecialchars(trim($formData['prenom']));
    $email = htmlspecialchars(trim($formData['email']));
    $pseudo = htmlspecialchars(trim($formData['pseudo']));
    $password = trim($formData['password']);
    $confirm_password = trim($formData['confirm_password']);

    if (empty($nom)) {
        $errors['nom'] = 'Le champ nom est requis.';
    }

    if (empty($prenom)) {
        $errors['prenom'] = 'Le champ prénom est requis.';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Veuillez entrer une adresse email valide.';
    }

    if (empty($pseudo)) {
        $errors['pseudo'] = 'Le champ pseudo est requis.';
    }

    if (empty($password)) {
        $errors['password'] = 'Le champ mot de passe est requis.';
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Les mots de passe ne correspondent pas.';
    }


    return ['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'pseudo' => $pseudo, 'password' => $password, 'errors' => $errors];
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les données du formulaire
    $formData = validateForm($_POST);

    // S'il n'y a pas d'erreurs de validation, enregistrer les données dans la base de données
    if (empty($formData['errors'])) {
        $adminModel = new AdminModel();
        $adminModel->getConnexion(); // Assurez-vous que la méthode getConnexion() se connecte à la base de données
        $newAdminId = $adminModel->insertAdmin($formData['nom'], $formData['prenom'], $formData['email'], $formData['pseudo'], $formData['password']);

        

       
        header("Location: http://localhost/MSC-1/admin");
        exit();
    }
}
?>

<!-- Le formulaire HTML pour créer un compte administrateur -->
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
            <label for="email">Email</label><br>
            <input type="email" class="form-control" name="email" id="email">
            <?php if (isset($formData['errors']['email'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['email']; ?></span>
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
            <label for="password">Mot de passe</label><br>
            <input type="password" class="form-control" name="password" id="password">
            <?php if (isset($formData['errors']['password'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['password']; ?></span>
            <?php } ?>
        </div>
        <div class="mb-5 form-group">
            <label for="confirm_password">Confirmer le mot de passe</label><br>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password">
            <?php if (isset($formData['errors']['confirm_password'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['confirm_password']; ?></span>
            <?php } ?>
        </div>
        <div class="row p-2">
            <button type="submit" class="btn my-3">Créer un compte administrateur</button>
        </div>
    </form>
</div>