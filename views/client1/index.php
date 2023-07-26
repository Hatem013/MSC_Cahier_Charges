<?php
session_start();

// Inclure les fichiers d'en-tête et de pied de page
include_once  ROOT . '/views/home/header.php';
include_once  ROOT . '/views/home/footer.php';
require_once  ROOT . '/App/Model.php';

class ClientModel extends Model
{
    // Fonction pour obtenir l'ID du client à partir de l'e-mail
    public function getClientId($pseudo)
    {
        $sql = "SELECT id FROM clients WHERE pseudo = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$pseudo]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Fonction pour insérer les informations du client dans la base de données
    public function insertClient($client_id, $nom, $email, $telephone, $adresse, $message, $secteur, $logoPathString)
    {
        $logovalue = ($logoPathString !== '') ? 1 : 0; // Vérifier s'il y a un logo et définir la valeur en conséquence
        $sql = "INSERT INTO entreprises (client_id, nom_entreprise, email, telephone, adresse_entreprise, message_entreprise, secteur_activite, logo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        echo "Requête SQL : " . $sql . "<br>";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$client_id, $nom, $email, $telephone, $adresse, $message, $secteur, $logoPathString]);
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formErrors = [];

    // Vérifier le nom de l'entreprise
    $nom = trim($_POST['nom_ent']);
    if (empty($nom)) {
        $formErrors['nom_ent'] = 'Le nom de l\'entreprise est requis.';
    } else {
        $nom = htmlspecialchars($nom);
    }

    // Vérifier l'e-mail de l'entreprise
    $email = filter_var($_POST['email_ent'], FILTER_VALIDATE_EMAIL);
    if (empty($email)) {
        $formErrors['email_ent'] = 'L\'adresse email de l\'entreprise est invalide.';
    }

    // Vérifier le numéro de téléphone de l'entreprise
    $telephone = trim($_POST['telephone_ent']);
    if (empty($telephone)) {
        $formErrors['telephone_ent'] = 'Le numéro de téléphone de l\'entreprise est requis.';
    }

    // Vérifier l'adresse de l'entreprise
    $adresse = trim($_POST['adresse_ent']);
    if (empty($adresse)) {
        $formErrors['adresse_ent'] = 'L\'adresse de l\'entreprise est requise.';
    } else {
        $adresse = htmlspecialchars($adresse);
    }

    // Vérifier le secteur d'activité
    $secteur = trim($_POST['secteur_ent']);
    if (empty($secteur)) {
        $formErrors['secteur_ent'] = 'Le secteur d\'activité de l\'entreprise est requis.';
    } else {
        $secteur = htmlspecialchars($secteur);
    }

    // Vérifier le message
    $message = trim($_POST['message_ent']);
    if (empty($message)) {
        $formErrors['message_ent'] = 'Le message est requis.';
    } else {
        $message = htmlspecialchars($message);
    }

    // Vérifier le logo
    $logo = trim($_POST['logo']);
    if (empty($logo)) {
        $formErrors['logo'] = 'Veuillez sélectionner si vous avez un logo ou non.';
    } else {
        $logo = htmlspecialchars($logo);
    }

    // Si l'utilisateur a répondu oui pour le logo, vérifier le fichier uploadé
    if ($logo === 'oui') {
        $logoFile = $_FILES['logo_file'];
        $logoPath = '';

        if (!empty($logoFile['name'])) {
            // Vérifier le type de fichier
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($logoFile['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                $formErrors['logo-file'] = 'Le format du logo doit être JPG, JPEG, PNG ou GIF.';
            } else {
                // Renommer le fichier
                $newLogoName = hash('sha256', uniqid() . $logoFile['name']) . '.' . $fileExtension;

                // Déplacer le fichier vers le dossier uploads
                $uploadPath = ROOT . 'Public/uploads/' . $newLogoName;
                if (!move_uploaded_file($logoFile['tmp_name'], $uploadPath)) {
                    $formErrors['logo-file'] = 'Une erreur est survenue lors du téléchargement du logo.';
                } else {
                    // Le chemin du fichier pour enregistrement dans la base de données
                    $logoPath = $uploadPath;
                }
            }
        } else {
            $formErrors['logo-file'] = 'Veuillez télécharger votre logo.';
        }
    }

    // Convertir le chemin de l'image en une chaîne de caractères
    $logoPathString = ($logoPath !== '') ? strval($logoPath) : '';

    // S'il n'y a pas d'erreurs de validation, insérer les données dans la base de données
    if (empty($formErrors)) {
        $clientModel = new ClientModel();
        $clientModel->getConnexion();

        try {
            // Récupérer l'identifiant du client depuis la session
            $client_id = $_SESSION['client_id'];

            // Enregistrer les informations de l'entreprise dans la base de données avec l'ID du client correspondant
            $clientModel->insertClient($client_id, $nom, $email, $telephone, $adresse, $message, $secteur, $logoPathString);

            // Stocker les informations dans la session
            $_SESSION['nom_ent'] = $nom;
            $_SESSION['message_ent'] = $message;
            $_SESSION['email_ent'] = $email;
            $_SESSION['telephone_ent'] = $telephone;
            $_SESSION['adresse_ent'] = $adresse;
            $_SESSION['secteur_ent'] = $secteur;
            $_SESSION['logo'] = $logoPath;

            // Rediriger vers l'étape suivante
            $_SESSION['currentStep'] = 2;
            header("Location: http://localhost/MSC-1/client2");
            exit();
        } catch (PDOException $e) {
            // Affichage d'une erreur en cas de problème avec la base de données
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>

<div class="container formulaire">

    <div class="container text-center mt-4 mb-5">
        <h1 class="mb-4">Information concernant votre entreprise</h1>
        <p><?php echo 'Bonjour '.$_SESSION['pseudo']?> veuillez rentrer les informations concernant votre entreprise afin de faciliter la création de votre site.</p>
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
                            <div class="form-group my-3 col-6">
                                <label for="secteur_ent">Secteur d'activité :</label>
                                <input type="text" class="form-control" id="secteur_ent" name="secteur_ent" required>
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
                                <div id="logo_file_field" style="display: none;">
                                    <div class="form-group my-4">
                                        <label id="logo_import_label" for="logo_file" class="btn">
                                            <i class="fa fa-cloud-upload"></i> Cliquez ici pour importez votre fichier
                                        </label>
                                        <input type="file" accept="image/*" name="logo_file" id="logo_file">
                                    </div>
                                </div>
                            </div>
                            <div class="col"><img id="logo_file_preview" src="#" style="width:150px" /></div>
                        </div>
                                <!-- Pas de logo -->  
                        <div id="logo_alert_field" style="display: none;">
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
                var_dump($_POST);
                ?>

            </div>
        </div>

    </div>
</div>
<script src="./Public/js/color_logo_form.js"></script>