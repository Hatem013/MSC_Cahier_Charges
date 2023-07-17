<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
?>

<?php
session_start();
$_SESSION['currentStep'] = 1;
require_once ROOT . 'App/Model.php';

class ClientModel extends Model
{
    public function insertClient($nom, $prenom, $email, $telephone, $adresse, $profession, $secteur, $logo)
    {

        $logovalue = ($logo === 'oui') ? 1 : 0;
        $sql = "INSERT INTO clients (nom, prenom, email, telephone, adresse, profession, secteur, logo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $profession, $secteur, $logovalue]);
    }
}
function validateForm($formData)
{
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
?>

<div class="container formulaire">
<div class="row">
    
        <div class="container text-center mt-4">
            <h1 class="mb-5">Création de votre site</h1>
        </div>
            
        <ul class="progressbar">
        <li <?php if ($_SESSION['currentStep'] == 1) {
                echo 'class="active"';
            } ?>><img src="./Public/asset/svg/one.svg" class="logo_current_progress"></li>
        <li class="in_progress"> -----🚧----- </li>
        <li <?php if ($_SESSION['currentStep'] == 2) {
                echo 'class="active"';
            } ?>><a href=<?php ROOT . "views/client2" ?>><img src="./Public/asset/svg/two.svg" class="logo_progress"></a></li>
        <li class="in_progress"> ----------- </li>
        <li <?php if ($_SESSION['currentStep'] == 3) {
                echo 'class="active"';
            } ?>><a href=<?php ROOT . "views/client3" ?>><img src="./Public/asset/svg/three.svg" class="logo_progress"></a></li>
            <li class="in_progress"> ----------- </li> 
        <li <?php if ($_SESSION['currentStep'] == 4) {
                echo 'class="active"';
            } ?>><a href=<?php ROOT . "views/client4" ?>><img src="./Public/asset/svg/four.svg" class="logo_progress"></a></li>
            <li class="in_progress"> ----------- </li> 
        <li <?php if ($_SESSION['currentStep'] == 5) {
                echo 'class="active"';
            } ?>><a href=<?php ROOT . "views/client5" ?>><img src="./Public/asset/svg/five.svg" class="logo_progress"></a></li>
            <li class="in_progress"> ----------- </li> 
        <li <?php if ($_SESSION['currentStep'] == 6) {
                echo 'class="active"';
            } ?>><a href=<?php ROOT . "views/client6" ?>><img src="./Public/asset/svg/six.svg" class="logo_progress"></a></li>
    </ul>
            
        <div class="container">
    
            <!-- Container formulaire-->
            <div class="row justify-content-center">
                
                <div class="col-md-8">
                <p class="text-center mb-5" >Vous avez un projet de site internet ? Renseignez vos informations nous nous occupons du reste.</p>
                    <!-- Formulaire -->
                    <form method="post" action="">
    
                        <!-- Nom et prénom -->
                        <div class="row my-3">
                            <div class="col-6">
                                <div class="form-group ">
    
                                    <label for="nom">Nom :</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
    
                                </div>
                            </div>
    
                            <div class="col-6">
                                <div class="form-group ">
    
                                    <label for="prenom">Prénom :</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
    
                                </div>
                            </div>
                        </div>
    
                        <!-- Adresse email -->
                        <div class="form-group my-3">
                            <label for="email">Adresse email :</label>
                            <input type="email" class="form-control" id="email" name="email" required">
                        </div>
    
                        <!-- Numéro de téléphone -->
                        <div class="form-group my-3">
                            <label for="telephone">Numéro de téléphone :</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" required>
                        </div>
    
                        <!-- Adresse postale -->
                        <div class="form-group my-3">
                            <label for="adresse">Adresse postale :</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>
    
    
                        <!-- Profession + Secteur d'activité -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="profession">Profession :</label>
                                    <input type="text" class="form-control" id="profession" name="profession" required>
                                </div>
    
                            </div>
    
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="secteur">Secteur d'activité :</label>
                                    <input type="text" class="form-control" id="secteur" name="secteur" required>
                                </div>
                            </div>
                        </div>
    
                        <!-- Bouton d'envoie -->
                        <div class="row p-2 ">
                            <button type="submit" class="btn my-3">Étape suivante -></button>
                        </div>
                    </form>
    
                    <!-- Message d'erreur -->
                    <div>
    
                        <?php
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
    
                                    $_SESSION['nom'] = $nom;
                                    $_SESSION['prenom'] = $prenom;
                                    $_SESSION['email'] = $email;
                                    $_SESSION['telephone'] = $telephone;
                                    $_SESSION['adresse'] = $adresse;
                                    $_SESSION['profession'] = $profession;
                                    $_SESSION['secteur'] = $secteur;
                                    $_SESSION['logo'] = $logo;
    
                                    header("Location: http://localhost/MSC-1/client2");
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
                    </div>
    
                </div>
            </div>
    
        </div>
</div>
</div>
<script src="./Public/js/progress.js"></script>
