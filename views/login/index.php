<?php
// Démarrer la session
session_start();

include_once ROOT . '/views/home/header.php';
include_once ROOT . '/views/home/footer.php';
require_once ROOT . '/App/Model.php';

class ClientModel extends Model {
    // Méthode pour récupérer un utilisateur par son adresse e-mail
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM clients WHERE email = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Méthode pour récupérer un utilisateur par son pseudo
    public function getUserByPseudo($pseudo) {
        $sql = "SELECT * FROM clients WHERE pseudo = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$pseudo]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    // Vous pouvez ajouter d'autres méthodes liées aux clients ici selon vos besoins
}

function validateForm($formData) {
  $errors = [];

  // Validation et échappement des données utilisateur pour prévenir les attaques XSS
  $identifiant = htmlspecialchars(trim($formData['identifiant']));
  $password = trim($formData['password']);

  if (empty($identifiant)) {
      $errors['identifiant'] = 'Le champ email ou pseudo est requis.';
  }

  if (empty($password)) {
      $errors['password'] = 'Le champ mot de passe est requis.';
  }

  return ['identifiant' => $identifiant, 'password' => $password, 'errors' => $errors];
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les données du formulaire
    $formData = validateForm($_POST);

    // S'il n'y a pas d'erreurs de validation, vérifier les informations de connexion
    if (empty($formData['errors'])) {
        $clientModel = new ClientModel();
        $clientModel->getConnexion();

        // Nettoyer et valider l'identifiant (email ou pseudo) avec FILTER_SANITIZE_EMAIL
        $cleanedIdentifiant = filter_var($formData['identifiant'], FILTER_SANITIZE_EMAIL);

        // Rechercher l'utilisateur par identifiant (email ou pseudo) dans la base de données
        if (filter_var($cleanedIdentifiant, FILTER_VALIDATE_EMAIL)) {
            // Rechercher l'utilisateur par e-mail dans la base de données
            $user = $clientModel->getUserByEmail($cleanedIdentifiant);
        } else {
            // Rechercher l'utilisateur par pseudo dans la base de données
            $user = $clientModel->getUserByPseudo($cleanedIdentifiant);
        }

        // Vérifier si l'utilisateur a été trouvé dans la base de données
        if ($user) {
            // Vérifier si le mot de passe saisi correspond au mot de passe haché dans la base de données
            if (password_verify($formData['password'], $user->password)) {
                // Mot de passe correct

                $_SESSION['client_id'] = $user->id;
                $_SESSION['pseudo'] = $user->pseudo;
                // Rediriger l'utilisateur vers le dashboard ou toute autre page appropriée
                header("Location: http://localhost/MSC-1/dashboard");
                exit();
            } else {
                // Mot de passe incorrect
                $formData['errors']['password'] = 'Mot de passe incorrect';
            }
        } else {
            // Utilisateur non trouvé dans la base de données
            $formData['errors']['identifiant'] = 'Identifiant invalide';
        }
    }
}
?>

<div class="container formulaire">
  <h1 class="text-center">Connexion</h1>
  <form method="post" class="mx-auto text-center" action="">
      <div class="mb-5 form-group">
          <label for="identifiant">Email ou Pseudo :</label>
          <input type="text" class="form-control <?php echo !empty($formData['errors']['identifiant']) ? 'is-invalid' : ''; ?>" name="identifiant" id="identifiant" value="<?php echo isset($formData['identifiant']) ? $formData['identifiant'] : ''; ?>" required>
          <?php if (!empty($formData['errors']['identifiant'])) : ?>
              <span class="text-danger">
                  <?php echo $formData['errors']['identifiant']; ?>
              </span>
          <?php endif; ?>
      </div>
      <div class="mb-5 form-group">
          <label for="password">Mot de passe :</label>
          <input type="password" class="form-control <?php echo !empty($formData['errors']['password']) ? 'is-invalid' : ''; ?>" name="password" id="password" required>
          <?php if (!empty($formData['errors']['password'])) : ?>
              <span class="text-danger">
                  <?php echo $formData['errors']['password']; ?>
              </span>
          <?php endif; ?>
      </div>
      <div class="mb-5 form-group">
          <button type="submit" class="form-control btn my-3">Se connecter</button>
      </div>
  </form>
  <p>Vous n'avez pas de compte ? <a href="http://localhost/MSC-1/register">Inscrivez-vous ici</a></p>
</div>