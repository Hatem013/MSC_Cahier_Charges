<?php
include_once ROOT . 'App/Model.php';


class ClientModel extends Model
{
    public function insertClient($nom, $prenom, $email, $telephone, $adresse, $profession, $secteur_activite, $nom_entreprise, $email_entreprise, $telephone_entreprise, $adresse_entreprise, $secteur_entreprise, $type_site, $nombre_couleurs, $couleur1, $couleur2, $couleur3, $logo, $logo_file, $message_entreprise, $header_desktop, $header_mobile, $footer_desktop)
    {
        $sql = "INSERT INTO nouveau_cahier (nom, prenom, email, telephone, adresse, profession, secteur_activite, nom_entreprise
        , email_entreprise, telephone_entreprise, adresse_entreprise, secteur_entreprise, type_site, nombre_couleurs, couleur1, couleur2, couleur3,
         logo, logo_file, message_entreprise, header_desktop, 
        header_mobile, footer_desktop) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $profession, $secteur_activite, $nom_entreprise, $email_entreprise, $telephone_entreprise, $adresse_entreprise, $secteur_entreprise, $type_site, $nombre_couleurs, $couleur1, $couleur2, $couleur3, $logo, $logo_file, $message_entreprise, $header_desktop, $header_mobile, $footer_desktop]);
    }
}
//Verifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formErrors = [];
    $formData = $_POST;
    $nom = htmlspecialchars(trim($formData['nom']));
    if (empty($nom)) {
        $formErrors['nom'] = 'Le nom de l\'entreprise est requis.';
    } else {
        $nom = htmlspecialchars($nom);
    }
    $prenom = htmlspecialchars(trim($formData['prenom']));
    if (empty($prenom)) {
        $formErrors['prenom'] = 'Le prénom est requis.';
    } else {
        $prenom = htmlspecialchars($prenom);
    }
    $email = htmlspecialchars(trim($formData['email']));
    if (empty($email)) {
        $formErrors['email'] = 'L\'email est requis.';
    } else {
        $email = htmlspecialchars($email);
    }
    $telephone = htmlspecialchars(trim($formData['telephone']));
    if (empty($telephone)) {
        $formErrors['telephone'] = 'Le numéro de téléphone est requis.';
    } else {
        $telephone = htmlspecialchars($telephone);
    }
    $adresse = htmlspecialchars(trim($formData['adresse']));
    if (empty($adresse)) {
        $formErrors['adresse'] = 'L\'adresse est requise.';
    } else {
        $adresse = htmlspecialchars($adresse);
    }
    $profession = htmlspecialchars(trim($formData['profession']));
    if (empty($profession)) {
        $formErrors['profession'] = 'La profession est requise.';
    } else {
        $profession = htmlspecialchars($profession);
    }
    $secteur_activite = htmlspecialchars(trim($formData['secteur_activite']));
    if (empty($secteur_activite)) {
        $formErrors['secteur_activite'] = 'Le secteur d\'activité est requis.';
    } else {
        $secteur_activite = htmlspecialchars($secteur_activite);
    }
    $nom_entreprise = htmlspecialchars(trim($formData['nom_entreprise']));
    if (empty($nom_entreprise)) {
        $formErrors['nom_entreprise'] = 'Le nom de l\'entreprise est requis.';
    } else {
        $nom_entreprise = htmlspecialchars($nom_entreprise);
    }
    $email_entreprise = htmlspecialchars(trim($formData['email_entreprise']));
    if (empty($email_entreprise)) {
        $formErrors['email_entreprise'] = 'L\'email de l\'entreprise est requis.';
    } else {
        $email_entreprise = htmlspecialchars($email_entreprise);
    }
    $telephone_entreprise = htmlspecialchars(trim($formData['telephone_entreprise']));
    if (empty($telephone_entreprise)) {
        $formErrors['telephone_entreprise'] = 'Le numéro de téléphone de l\'entreprise est requis.';
    } else {
        $telephone_entreprise = htmlspecialchars($telephone_entreprise);
    }
    $adresse_entreprise = htmlspecialchars(trim($formData['adresse_entreprise']));
    if (empty($adresse_entreprise)) {
        $formErrors['adresse_entreprise'] = 'L\'adresse de l\'entreprise est requise.';
    } else {
        $adresse_entreprise = htmlspecialchars($adresse_entreprise);
    }
    $secteur_entreprise = htmlspecialchars(trim($formData['secteur_entreprise']));
    if (empty($secteur_entreprise)) {
        $formErrors['secteur_entreprise'] = 'Le secteur d\'activité de l\'entreprise est requis.';
    } else {
        $secteur_entreprise = htmlspecialchars($secteur_entreprise);
    }
    $type_site = htmlspecialchars(trim($formData['type_site']));
    if (empty($type_site)) {
        $formErrors['type_site'] = 'Le type de site est requis.';
    } else {
        $type_site = htmlspecialchars($type_site);
    }
    $nombre_couleurs = htmlspecialchars(trim($formData['nombre_couleurs']));
    if (empty($nombre_couleurs)) {
        $formErrors['nombre_couleurs'] = 'Le nombre de couleurs est requis.';
    } else {
        $nombre_couleurs = htmlspecialchars($nombre_couleurs);
    }
    $couleur1 = htmlspecialchars(trim($formData['couleur1']));
    if (empty($couleur1)) {
        $formErrors['couleur1'] = 'La couleur 1 est requise.';
    } else {
        $couleur1 = htmlspecialchars($couleur1);
    }
    $couleur2 = htmlspecialchars(trim($formData['couleur2']));
    if (empty($couleur2)) {
        $formErrors['couleur2'] = 'La couleur 2 est requise.';
    } else {
        $couleur2 = htmlspecialchars($couleur2);
    }
    $couleur3 = htmlspecialchars(trim($formData['couleur3']));
    if (empty($couleur3)) {
        $formErrors['couleur3'] = 'La couleur 3 est requise.';
    } else {
        $couleur3 = htmlspecialchars($couleur3);
    }
    $logo = htmlspecialchars(trim($formData['logo']));
    if (empty($logo)) {
        $formErrors['logo'] = 'Le logo est requis.';
    } else {
        $logo = htmlspecialchars($logo);
    }
    if ($logo === 'oui') {
        $logoFile = $_POST['logo_file'];
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

    $logo_file = htmlspecialchars(trim($formData['logo_file']));
    
    $message_entreprise = htmlspecialchars(trim($formData['message_entreprise']));
    if (empty($message_entreprise)) {
        $formErrors['message_entreprise'] = 'Le message de l\'entreprise est requis.';
    } else {
        $message_entreprise = htmlspecialchars($message_entreprise);
    }
    $header_desktop = htmlspecialchars(trim($formData['header_desktop']));
    if (empty($header_desktop)) {
        $formErrors['header_desktop'] = 'Le header desktop est requis.';
    } else {
        $header_desktop = htmlspecialchars($header_desktop);
    }
    $header_mobile = htmlspecialchars(trim($formData['header_mobile']));
    if (empty($header_mobile)) {
        $formErrors['header_mobile'] = 'Le header mobile est requis.';
    } else {
        $header_mobile = htmlspecialchars($header_mobile);
    }
    $footer_desktop = htmlspecialchars(trim($formData['footer_desktop']));
    if (empty($footer_desktop)) {
        $formErrors['footer_desktop'] = 'Le footer desktop est requis.';
    } else {
        $footer_desktop = htmlspecialchars($footer_desktop);
    }

    if (empty($formErrors)) {
        $clientModel = new ClientModel();
        $clientModel->getConnexion();
        try {
            $clientModel->insertClient($nom, $prenom, $email, $telephone, $adresse, $profession, $secteur_activite, $nom_entreprise, $email_entreprise, $telephone_entreprise, $adresse_entreprise, $secteur_entreprise, $type_site, $nombre_couleurs, $couleur1, $couleur2, $couleur3, $logo, $logoPathString, $message_entreprise, $header_desktop, $header_mobile, $footer_desktop);
            header('Location: http://localhost/MSC-1/dashboard');
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
   
}
