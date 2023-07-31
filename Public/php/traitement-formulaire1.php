<?php
include_once ROOT . 'App/Model.php';

class ClientModel extends Model
{
    public function insertClient($nom, $prenom, $email, $telephone, $adresse, $profession, $secteur_activite, $nom_entreprise, $email_entreprise, $telephone_entreprise, $adresse_entreprise, $secteur_entreprise, $type_site, $nombre_couleurs, $couleur1, $couleur2, $couleur3, $logo, $logo_file, $message_entreprise, $header_desktop, $header_mobile, $footer_desktop)
    {
        $sql = "INSERT INTO nouveau_cahier (nom, prenom, email, telephone, adresse, profession, secteur_activite, nom_entreprise, email_entreprise, telephone_entreprise, adresse_entreprise, secteur_entreprise, type_site, nombre_couleurs, couleur1, couleur2, couleur3, logo, logo_file, message_entreprise, header_desktop, header_mobile, footer_desktop) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $profession, $secteur_activite, $nom_entreprise, $email_entreprise, $telephone_entreprise, $adresse_entreprise, $secteur_entreprise, $type_site, $nombre_couleurs, $couleur1, $couleur2, $couleur3, $logo, $logo_file, $message_entreprise, $header_desktop, $header_mobile, $footer_desktop]);
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Simplification des vérifications des champs requis
    $nom = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : '';
    $prenom = isset($_POST['prenom']) ? htmlspecialchars(trim($_POST['prenom'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $telephone = isset($_POST['telephone']) ? htmlspecialchars(trim($_POST['telephone'])) : '';
    $adresse = isset($_POST['adresse']) ? htmlspecialchars(trim($_POST['adresse'])) : '';
    $profession = isset($_POST['profession']) ? htmlspecialchars(trim($_POST['profession'])) : '';
    $secteur_activite = isset($_POST['secteur_activite']) ? htmlspecialchars(trim($_POST['secteur_activite'])) : '';
    $nom_entreprise = isset($_POST['nom_entreprise']) ? htmlspecialchars(trim($_POST['nom_entreprise'])) : '';
    $email_entreprise = isset($_POST['email_entreprise']) ? htmlspecialchars(trim($_POST['email_entreprise'])) : '';
    $telephone_entreprise = isset($_POST['telephone_entreprise']) ? htmlspecialchars(trim($_POST['telephone_entreprise'])) : '';
    $adresse_entreprise = isset($_POST['adresse_entreprise']) ? htmlspecialchars(trim($_POST['adresse_entreprise'])) : '';
    $secteur_entreprise = isset($_POST['secteur_entreprise']) ? htmlspecialchars(trim($_POST['secteur_entreprise'])) : '';
    $type_site = isset($_POST['type_site']) ? htmlspecialchars(trim($_POST['type_site'])) : '';
    $nombre_couleurs = isset($_POST['nombre_couleurs']) ? htmlspecialchars(trim($_POST['nombre_couleurs'])) : '';
    $couleur1 = isset($_POST['couleur1']) ? htmlspecialchars(trim($_POST['couleur1'])) : '';
    $couleur2 = isset($_POST['couleur2']) ? htmlspecialchars(trim($_POST['couleur2'])) : '';
    $couleur3 = isset($_POST['couleur3']) ? htmlspecialchars(trim($_POST['couleur3'])) : '';
    $logo = isset($_POST['logo']) ? htmlspecialchars(trim($_POST['logo'])) : '';
    $logo_file = '';
    $logoPathString = '';

    if ($logo === 'oui') {
        $logoFile = $_FILES['logo_file'];

        if (!empty($logoFile['name'])) {
            // Vérifier le type de fichier
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($logoFile['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                $formErrors['logo-file'] = 'Le format du logo doit être JPG, JPEG, PNG ou GIF.';
            } else {
                // Renommer le fichier
                $newLogoName = hash('sha256', uniqid() . $logoFile['name']) . '.' . $fileExtension;

                // Déplacer le fichier vers le dossier uploads
                $uploadPath =  './Public/uploads/' . $newLogoName;
                if (!move_uploaded_file($logoFile['tmp_name'], $uploadPath)) {
                    $formErrors['logo-file'] = 'Une erreur est survenue lors du téléchargement du logo.';
                } else {
                    // Le chemin du fichier pour enregistrement dans la base de données
                    $logoPathString = $uploadPath;
                }
            }
        } else {
            $formErrors['logo-file'] = 'Veuillez télécharger votre logo.';
        }
    }

    // Simplification des autres vérifications des champs requis
    $message_entreprise = isset($_POST['message_entreprise']) ? htmlspecialchars(trim($_POST['message_entreprise'])) : '';
    $header_desktop = isset($_POST['header_desktop']) ? htmlspecialchars(trim($_POST['header_desktop'])) : '';
    $header_mobile = isset($_POST['header_mobile']) ? htmlspecialchars(trim($_POST['header_mobile'])) : '';
    $footer_desktop = isset($_POST['footer_desktop']) ? htmlspecialchars(trim($_POST['footer_desktop'])) : '';

    // Effectuer l'insertion dans la base de données si aucun champ n'est vide
    if (
        !empty($nom) && !empty($prenom) && !empty($email) && !empty($telephone) && !empty($adresse) &&
        !empty($profession) && !empty($secteur_activite) && !empty($nom_entreprise) && !empty($email_entreprise) &&
        !empty($telephone_entreprise) && !empty($adresse_entreprise) && !empty($secteur_entreprise) && !empty($type_site) &&
        !empty($nombre_couleurs) && !empty($couleur1) && !empty($couleur2) && !empty($couleur3) && !empty($logo) &&
        !empty($message_entreprise) && !empty($header_desktop) && !empty($header_mobile) && !empty($footer_desktop)
    ) {
        $clientModel = new ClientModel();
        $clientModel->getConnexion();
        try {
            $clientModel->insertClient($nom, $prenom, $email, $telephone, $adresse, $profession, $secteur_activite, $nom_entreprise, $email_entreprise, $telephone_entreprise, $adresse_entreprise, $secteur_entreprise, $type_site, $nombre_couleurs, $couleur1, $couleur2, $couleur3, $logo, $logo_file, $message_entreprise, $header_desktop, $header_mobile, $footer_desktop);
            header('Location: http://localhost/MSC-1/dashboard');
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
