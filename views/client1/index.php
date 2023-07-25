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
    public function insertClient($nom, $email, $telephone, $adresse, $message)
    {


        $sql = "INSERT INTO clients (nom_ent, email_ent, telephone_ent, adresse_ent, message_ent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$nom, $email, $telephone, $adresse, $message]);
    }
}
function validateForm($formData)
{
    $errors = [];

    if (empty($formData['nom_ent'])) {
        $errors['nom-ent'] = 'Le champ nom est requis.';
    }

    if (empty($formData['email_ent']) || !filter_var($formData['email_ent'], FILTER_VALIDATE_EMAIL)) {
        $errors['email-ent'] = 'Veuillez entrer une adresse email valide.';
    }

    if (empty($formData['telephone_ent'])) {
        $errors['telephone-ent'] = 'Le champ téléphone est requis.';
    }
    if (empty($formData['adresse_ent'])) {
        $errors['adresse-ent'] = 'Le champ adresse est requis.';
    }

    if (empty($formData['message_ent'])) {
        $errors['message-ent'] = "Donnez un minimum d'information concernant votre entreprise.";
    }

    return $errors;
}
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

<div class="container formulaire">

    <div class="container text-center mt-4 mb-5">
        <h1 class="mb-4">Information concernant votre entreprise</h1>
        <p>Veuillez rentrer les informations concernant votre entreprise afin de faciliter la création de votre site.</p>
    </div>
    <ul class="progressbar">
        <li <?php if ($_SESSION['currentStep'] == 1) {
                echo 'class="active"';
            } ?>><img src="./Public/asset/svg/one.svg" class="logo_previous_progress"></li>
        <li class="progressed"> -----✔️----- </li>
        <li <?php if ($_SESSION['currentStep'] == 2) {
                echo 'class="active"';
            } ?>><a href=<?php ROOT . "views/client2" ?>><img src="./Public/asset/svg/two.svg" class="logo_current_progress"></a></li>
        <li class="in_progress"> -----🚧------ </li>
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

                <!-- Formulaire -->
                <form method="post" action="">

                    <!-- Nom -->
                    <div class="testing">
                        <div class="row my-3">
                            <div class="col-6">
                                <div class="form-group ">

                                    <label for="nom_ent">Nom commercial</label>
                                    <input type="text" class="form-control" id="nom_ent" name="nom_ent" required>

                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-6">
                                <div class="form-group">

                                    <label for="prenom_ent">Adresse email :</label>
                                    <input type="email" class="form-control" id="email_ent" name="email_ent" required>

                                </div>
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div class="row">
                            <div class="form-group my-3 col-6">
                                <label for="adresse_ent">Adresse postale :</label>
                                <input type="text" class="form-control" id="adresse_ent" name="adresse_ent" required">
                            </div>

                            <!-- Numéro de téléphone -->
                            <div class="form-group my-3 col-6">
                                <label for="telephone_ent">Numéro de téléphone :</label>
                                <input type="tel" class="form-control" id="telephone_ent" name="telephone_ent" required>
                            </div>
                        </div>

                        <!-- Logo-->
                        <div class="row align-items-center">
                            <div class="col-7">
                                <div class="form-group" required>
                                    <label for="logo">Avez-vous un logo ?</label>
                                    <input type="radio" name="logo" id="logo_oui" value="oui" onclick="showLogoFields(); logoSelectionValidate()" required>
                                    <label id="logo_label_oui" class="btn" for="logo_oui">Oui</label>
                                    <input type="radio" name="logo" id="logo_non" value="non" onclick="showLogoFields(); logoSelectionValidate()" required>
                                    <label id="logo_label_non" class="btn" for="logo_non">Non</label>
                                </div>
                        
                                <!-- Import logo -->
                                <div id="logo-file-field" style="display: none;">
                                    <div class="form-group my-4">
                                        <label id="logo_import_label" for="logo_file" class="btn">
                                            <i class="fa fa-cloud-upload"></i> Cliquez ici pour importez votre fichier
                                        </label>
                                        <input type="file" accept="image/*" name="logo-file" id="logo_file">
                                    </div>
                                </div>
                            </div>
                            <div class="col"><img id="logo_file_preview" src="#" style="width:150px" /></div>
                        </div>
                                <!-- Pas de logo -->  
                        <div id="create-logo-field" style="display: none;">
                            <div class="form-group my-4">
                                <p>⚠️ Le logo étant nécessaire, une proposition vous sera faites afin de vous créer un logo personnalisé ⚠️</p>
                            </div>
                        </div>

                                <!-- Preview du logo si importé -->
                        <script>
                            if (logo_file.files.length == 0) {
                                logo_file_preview.style.display = "none"
                            }

                            logo_file.onchange = evt => {
                                const [file] = logo_file.files
                                if (file) {
                                    logo_file_preview.src = URL.createObjectURL(file)
                                    logo_file_preview.style.display = "unset"
                                }
                                    logo_import_label.innerHTML = "Cliquez ici pour modifier votre logo";
                                    logo_import_label.classList.add("btn_validate");

                            }
                        </script>

                        <!-- Message -->
                        <div class="form-group my-3">
                            <label class="mb-2" for="message_ent">Parlez-nous un peu plus de votre entreprise (Les services que vous proposez, ce que vendez ou créez etc..) :</label>
                            <textarea class="form-control" name="message_ent" id="message_ent" rows="12" required></textarea>
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
                            $nom = $_POST['nom-ent'];
                            $email = $_POST['email-ent'];
                            $telephone = $_POST['telephone-ent'];
                            $adresse = $_POST['adresse-ent'];
                            $message = $_POST['message-ent'];

                            try {
                                $clientModel->insertClient($nom, $message, $email, $telephone, $adresse);

                                $_SESSION['nom-ent'] = $nom;
                                $_SESSION['message-ent'] = $message;
                                $_SESSION['email-ent'] = $email;
                                $_SESSION['telephone-ent'] = $telephone;
                                $_SESSION['adresse-ent'] = $adresse;

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
<script src="./Public/js/progress.js"></script>
<script src="./Public/js/formulaire.js"></script>