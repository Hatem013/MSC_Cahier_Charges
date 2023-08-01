<?php
session_start();

include_once ROOT . '/views/home/header.php';
include_once ROOT . '/views/home/footer.php';
require_once ROOT . '/App/Model.php'; 

class AdminModel extends Model
{
    public function getAdminByEmail($email)
    {
        $sql = "SELECT * FROM administrateurs WHERE email = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

function validateLoginForm($formData)
{
    $errors = [];


    $email = htmlspecialchars(trim($formData['email']));
    $password = trim($formData['password']);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Veuillez entrer une adresse email valide.';
    }

    if (empty($password)) {
        $errors['password'] = 'Le champ mot de passe est requis.';
    }

    return ['email' => $email, 'password' => $password, 'errors' => $errors];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $formData = validateLoginForm($_POST);


    if (empty($formData['errors'])) {
        $adminModel = new AdminModel();
        $adminModel->getConnexion(); 
        $admin = $adminModel->getAdminByEmail($formData['email']);

        if ($admin && password_verify($formData['password'], $admin['password'])) {
            // Admin login successful
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: http://localhost/MSC-1/admin");
            exit();
        } else {
            $formData['errors']['login_failed'] = 'Les informations de connexion sont incorrectes.';
        }
    }
}
?>


<div class="container formulaire">
    <form class="mx-auto text-center" method="post">
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
            <?php if (isset($formData['errors']['login_failed'])) { ?>
                <span class="text-danger"><?php echo $formData['errors']['login_failed']; ?></span>
            <?php } ?>
        </div>
        <div class="row p-2">
            <button type="submit" class="btn my-3">Se connecter</button>
        </div>
    </form>
</div>