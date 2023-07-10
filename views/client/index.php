<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
?>

<h1>Créer votre site</h1>
<p>Vous avez un projet de site internet ? Renseignez vos informations nous nous occupons du reste.</p>
<?php


require_once ROOT . 'App/Model.php';


class ClientModel extends Model {
    public function insertClient($nom, $prenom, $email, $telephone, $profession, $secteur) {
        $sql = "INSERT INTO clients (nom, prenom, email, telephone, profession, secteur) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $telephone, $profession, $secteur]);
    }
}

function validateForm($formData) {
    $errors = [];

    if (empty($formData['nom'])) {
        $errors['nom'] = 'Le champ nom est requis.';
    }

    if (empty($formData['prenom'])) {
        $errors['prenom'] = 'Le champ prénom est requis.';
    }

    if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Veuillez entrer une adresse email valide.';
    }

    if (empty($formData['telephone'])) {
        $errors['telephone'] = 'Le champ téléphone est requis.';
    }
    if (empty($formData['adresse'])) {
        $errors['adresse'] = 'Le champ adresse est requis.';
    }

    if (empty($formData['profession'])) {
        $errors['profession'] = 'Le champ profession est requis.';
    }

    if (empty($formData['secteur'])) {
        $errors['secteur'] = 'Le champ secteur est requis.';
    }

    return $errors;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientModel = new ClientModel();
    $clientModel->getConnexion();

    $formErrors = validateForm($_POST);

    if (empty($formErrors)) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $profession = $_POST['profession'];
        $secteur = $_POST['secteur'];
        $logo = isset($_POST['logo']) ? $_POST['logo'] : '';

        try {
            $clientModel->insertClient($nom, $prenom, $email, $telephone, $adresse, $profession, $secteur, $logo);
            $logoValue = ($logo === 'oui') ? 1 : 0;

            header("Location:".ROOT."views/client2/index.php?nom=$nom&prenom=$prenom&email=$email&telephone=$telephone&adresse=$adresse&profession=$profession&secteur=$secteur&logo=$logo");
            exit();
        } catch (PDOException $e) {
            // Affichage d'une erreur en cas de problème avec la base de données
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        // Affichage des erreurs de validation
        foreach ($formErrors as $fieldName => $errorMessage) {
            echo "<p>Erreur pour le champ $fieldName : $errorMessage</p>";
        }
    }
}


?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone :</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse :</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>

                <div class="form-group">
                    <label for="profession">Profession :</label>
                    <input type="text" class="form-control" id="profession" name="profession" required>
                </div>

                <div class="form-group">
                    <label for="secteur">Secteur d'activité :</label>
                    <input type="text" class="form-control" id="secteur" name="secteur" required>
                </div>
                <div class="form-group">
                    <p>Avez-vous un logo ?</p>
                        <input type="radio" id="logoChoice1" name="logo" value="oui" checked>
                        <label for="logoChoice1">Oui</label>
                        <input type="radio" id="logoChoice2" name="logo" value="non">
                        <label for="logoChoice2">Non</label>
                </div>

                <button type="submit" class="btn btn-primary">Formulaire Suivant</button>
                <button type="reset" class="btn btn-danger">Annuler</button>
            </form>
        </div>
    </div>
</div>