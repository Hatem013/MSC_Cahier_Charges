<?php
//Formulaire 1
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
    public function insertClientSite($typesite, $nombreCouleurs, $couleur1, $couleur2, $couleur3)
    {
        $sql = "INSERT INTO sites (type_site, nombre_couleur, couleur1, couleur2, couleur3) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$typesite, $nombreCouleurs, $couleur1, $couleur2, $couleur3]);
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

//Formulaire 2
$_SESSION['currentStep'] = 1;


    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientModel = new ClientModel();
    $clientModel->getConnexion();

    $formErrors = [];

    // Validation des champs du formulaire
    $typeSite = trim($_POST['type_site']);
    if (empty($typeSite)) {
        $formErrors['type_site'] = 'Veuillez sélectionner le type de site.';
    } else {
        $typeSite = htmlspecialchars($typeSite);
    }

    // Vérifier le nombre de couleurs
    $nombreCouleurs = filter_input(INPUT_POST, 'nombre-couleurs', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 3]]);
    if ($nombreCouleurs === false) {
        $formErrors['nombre-couleurs'] = 'Le nombre de couleurs sélectionné est invalide.';
    }

    // Vérifier la couleur 1
    $couleur1 = trim($_POST['couleur1']);
    if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $couleur1)) {
        $formErrors['couleur1'] = 'La couleur 1 n\'est pas au format valide (ex: #RRGGBB).';
    } else {
        $couleur1 = htmlspecialchars($couleur1);
    }

    // Vérifier la couleur 2
    $couleur2 = trim($_POST['couleur2']);
    if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $couleur2)) {
        $formErrors['couleur2'] = 'La couleur 2 n\'est pas au format valide (ex: #RRGGBB).';
    } else {
        $couleur2 = htmlspecialchars($couleur2);
    }

    // Vérifier la couleur 3
    $couleur3 = trim($_POST['couleur3']);
    if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $couleur3)) {
        $formErrors['couleur3'] = 'La couleur 3 n\'est pas au format valide (ex: #RRGGBB).';
    } else {
        $couleur3 = htmlspecialchars($couleur3);
    }

    if (empty($typesite)) {
        $formErrors['type_site'] = "Veuillez sélectionner un type de site.";
    }

    if ($nombre_couleurs === false) {
        $formErrors['nombre-couleurs'] = "Le nombre de couleurs doit être un nombre entre 0 et 3.";
    }

    // Vérification de la validité des couleurs si le nombre de couleurs est supérieur à 0
    if ($nombreCouleurs > 0) {
        $pattern = "/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/";
        if (!preg_match($pattern, $couleur1)) {
            $formErrors['couleur1'] = "Couleur 1 invalide. Veuillez entrer une couleur au format hexadécimal (#RRGGBB).";
        }
        if ($nombreCouleurs > 1 && !preg_match($pattern, $couleur2)) {
            $formErrors['couleur2'] = "Couleur 2 invalide. Veuillez entrer une couleur au format hexadécimal (#RRGGBB).";
        }
        if ($nombreCouleurs > 2 && !preg_match($pattern, $couleur3)) {
            $formErrors['couleur3'] = "Couleur 3 invalide. Veuillez entrer une couleur au format hexadécimal (#RRGGBB).";
        }
    }

    // Si le formulaire ne contient pas d'erreurs, insérer les données dans la base de données
    if (empty($formErrors)) {
        try {
            $clientModel->insertClientSite($typesite, $nombreCouleurs, $couleur1, $couleur2, $couleur3);

            $_SESSION['type_site'] = $typesite;
            $_SESSION['nombre-couleurs'] = $nombreCouleurs;
            $_SESSION['couleur1'] = $couleur1;
            $_SESSION['couleur2'] = $couleur2;
            $_SESSION['couleur3'] = $couleur3;

            header("Location: http://localhost/MSC-1/client3");
            exit();
        } catch (PDOException $e) {
            // Affichage d'une erreur en cas de problème avec la base de données
            echo "Erreur : " . $e->getMessage();
        }
    }
}
$_SESSION['currentStep'] = 5;
require_once ROOT . 'App/Model.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['palette'])) {
        $selectedPaletteIndex = $_POST['palette'];
        $selectedPalette = $colorPalettes[$selectedPaletteIndex];
        echo "Palette sélectionnée : " . implode(', ', $selectedPalette);
    } else {
        echo "Aucune palette sélectionnée.";
    }
}
?>

































