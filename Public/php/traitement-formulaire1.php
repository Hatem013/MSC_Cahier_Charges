<?php
session_start();
require_once ROOT . '/App/Model.php';

class NouveauCahierModel extends Model
{
    public $table = 'nouveau_cahier';

    public function insertNouveauCahier($client_id, $nom, $prenom, $email, $telephone, $adresse, $profession, $secteur_activite, $nom_entreprise, $email_entreprise, $telephone_entreprise, $adresse_entreprise, $secteur_entreprise, $type_site, $nombre_couleurs, $couleur1, $couleur2, $couleur3, $logo, $logo_file, $message_entreprise, $header_desktop, $header_mobile, $footer_desktop, $footer_mobile)
    {
        $sql = "INSERT INTO nouveau_cahier (client_id, nom, prenom, email, telephone, adresse, profession, secteur_activite, nom_entreprise, email_entreprise, telephone_entreprise, adresse_entreprise, secteur_entreprise, type_site, nombre_couleurs, couleur1, couleur2, couleur3, logo, logo_file, message_entreprise, header_desktop, header_mobile, footer_desktop, footer_mobile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Utiliser la connexion définie dans la classe parente Model
        $stmt = $this->connexion->prepare($sql);
        return $stmt->execute([$client_id, $nom, $prenom, $email, $telephone, $adresse, $profession, $secteur_activite, $nom_entreprise, $email_entreprise, $telephone_entreprise, $adresse_entreprise, $secteur_entreprise, $type_site, $nombre_couleurs, $couleur1, $couleur2, $couleur3, $logo, $logo_file, $message_entreprise, $header_desktop, $header_mobile, $footer_desktop, $footer_mobile]);
    }
}

function validateForm($formData)
{
    $errors = [];

    // Validation et échappement des données utilisateur pour prévenir les attaques XSS
    $nom = htmlspecialchars(trim($formData['nom']));
    $prenom = htmlspecialchars(trim($formData['prenom']));
    $email = htmlspecialchars(trim($formData['email']));
    $telephone = htmlspecialchars(trim($formData['telephone']));
    $adresse = htmlspecialchars(trim($formData['adresse']));
    $profession = htmlspecialchars(trim($formData['profession']));
    $secteur_activite = htmlspecialchars(trim($formData['secteur_activite']));
    $nom_entreprise = htmlspecialchars(trim($formData['nom_entreprise']));
    $email_entreprise = htmlspecialchars(trim($formData['email_entreprise']));
    $telephone_entreprise = htmlspecialchars(trim($formData['telephone_entreprise']));
    $adresse_entreprise = htmlspecialchars(trim($formData['adresse_entreprise']));
    $secteur_entreprise = htmlspecialchars(trim($formData['secteur_entreprise']));
    $type_site = htmlspecialchars(trim($formData['type_site']));
    $nombre_couleurs = htmlspecialchars(trim($formData['nombre_couleurs']));
    $couleur1 = htmlspecialchars(trim($formData['couleur1']));
    $couleur2 = htmlspecialchars(trim($formData['couleur2']));
    $couleur3 = htmlspecialchars(trim($formData['couleur3']));
    $logo = htmlspecialchars(trim($formData['logo']));
    $logo_file = '';

    if ($logo === 'oui') {
        $logoFile = $_FILES['logo_file'];

        if (!empty($logoFile['name'])) {
            // Vérifier le type de fichier
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($logoFile['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                $errors['logo-file'] = 'Le format du logo doit être JPG, JPEG, PNG ou GIF.';
            } else {
                // Renommer le fichier avec le pseudo du client
                $pseudo_client = $nom . '_' . $prenom;
                $newLogoName = hash('sha256', $pseudo_client . $logoFile['name']) . '.' . $fileExtension;
                $uploadPath =  './Public/uploads/' . $newLogoName;

                // Déplacer le fichier vers le dossier uploads
                if (!move_uploaded_file($logoFile['tmp_name'], $uploadPath)) {
                    $errors['logo-file'] = 'Une erreur est survenue lors du téléchargement du logo.';
                } else {
                    // Le chemin du fichier pour enregistrement dans la base de données
                    $logo_file = $uploadPath;
                }
            }
        } else {
            $errors['logo-file'] = 'Veuillez télécharger votre logo.';
        }
    }


    $message_entreprise = htmlspecialchars(trim($formData['message_entreprise']));
    $header_desktop = htmlspecialchars(trim($formData['header_desktop']));
    $header_mobile = htmlspecialchars(trim($formData['header_mobile']));
    $footer_desktop = htmlspecialchars(trim($formData['footer_desktop']));
    $footer_mobile = htmlspecialchars(trim($formData['footer_mobile']));


    return [
        'client_id' => $_SESSION['client_id'],
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'telephone' => $telephone,
        'adresse' => $adresse,
        'profession' => $profession,
        'secteur_activite' => $secteur_activite,
        'nom_entreprise' => $nom_entreprise,
        'email_entreprise' => $email_entreprise,
        'telephone_entreprise' => $telephone_entreprise,
        'adresse_entreprise' => $adresse_entreprise,
        'secteur_entreprise' => $secteur_entreprise,
        'type_site' => $type_site,
        'nombre_couleurs' => $nombre_couleurs,
        'couleur1' => $couleur1,
        'couleur2' => $couleur2,
        'couleur3' => $couleur3,
        'logo' => $logo,
        'logo_file' => $logo_file,
        'message_entreprise' => $message_entreprise,
        'header_desktop' => $header_desktop,
        'header_mobile' => $header_mobile,
        'footer_desktop' => $footer_desktop,
        'footer_mobile' => $footer_mobile,
        'errors' => $errors
    ];
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les données du formulaire
    $formData = validateForm($_POST);

    // S'il n'y a pas d'erreurs de validation, enregistrer les données dans la base de données
    if (empty($formData['errors'])) {
        try {
            $nouveauCahierModel = new NouveauCahierModel();
            $conn = $nouveauCahierModel->getConnexion();

            // Insérer les données dans la table nouveau_cahier en incluant l'ID du client
            $result = $nouveauCahierModel->insertNouveauCahier(
                $formData['client_id'],
                $formData['nom'],
                $formData['prenom'],
                $formData['email'],
                $formData['telephone'],
                $formData['adresse'],
                $formData['profession'],
                $formData['secteur_activite'],
                $formData['nom_entreprise'],
                $formData['email_entreprise'],
                $formData['telephone_entreprise'],
                $formData['adresse_entreprise'],
                $formData['secteur_entreprise'],
                $formData['type_site'],
                $formData['nombre_couleurs'],
                $formData['couleur1'],
                $formData['couleur2'],
                $formData['couleur3'],
                $formData['logo'],
                $formData['logo_file'],
                $formData['message_entreprise'],
                $formData['header_desktop'],
                $formData['header_mobile'],
                $formData['footer_desktop'],
                $formData['footer_mobile']
            );

            // Vérifier les résultats
            var_dump($formData['client_id']);
            var_dump($result);

            if ($result) {
                // Requête exécutée avec succès
                header('Location: http://localhost/MSC-1/dashboard');
                exit; // Ajoutez cette ligne pour terminer le script ici
            } else {
                // Erreur lors de l'exécution de la requête
                $errorInfo = $stmt->errorInfo();
                echo "Erreur lors de l'exécution de la requête : " . $errorInfo[2];
                exit; // Ajoutez cette ligne pour terminer le script en cas d'erreur
            }
        } catch (PDOException $e) {
            // Erreur lors de la préparation de la requête
            echo "Erreur lors de la préparation de la requête : " . $e->getMessage();
            exit; // Ajoutez cette ligne pour terminer le script en cas d'erreur
        }
    }
}
?>