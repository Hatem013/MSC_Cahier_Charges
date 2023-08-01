<?php
// Vérifier si l'administrateur est connecté
// Si non, rediriger vers la page de connexion
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: http://localhost/MSC-1/adminlogin');
    exit;
}

// Inclure les fichiers nécessaires ici (header, footer, etc.)
include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
require_once ROOT . 'App/Model.php'; 

class AdminModel extends Model
{
    public function getClientsAndNouveauCahiers()
    {
        $sql = "SELECT c.id AS client_id, c.nom AS client_nom, c.prenom AS client_prenom, c.email AS client_email, c.telephone AS client_telephone, c.adresse AS client_adresse, nc.* FROM clients c LEFT JOIN nouveau_cahier nc ON c.id = nc.client_id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateClient($id, $data)
    {
        // Construction de la clause SQL dynamiquement
        $columns = array_keys($data);
        $values = array_values($data);
        $placeholders = implode('=?, ', $columns) . '=?';
        $sql = "UPDATE clients SET $placeholders WHERE id=?";
        $values[] = $id;

        $stmt = $this->connexion->prepare($sql);
        return $stmt->execute($values);
    }

    public function updateNouveauCahier($id, $data)
    {
        // Construction de la clause SQL dynamiquement
        $columns = array_keys($data);
        $values = array_values($data);
        $placeholders = implode('=?, ', $columns) . '=?';
        $sql = "UPDATE nouveau_cahier SET $placeholders WHERE id=?";
        $values[] = $id;

        $stmt = $this->connexion->prepare($sql);
        return $stmt->execute($values);
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les données du formulaire et les mettre dans un tableau
    $formDataClient = [
        'nom' => htmlspecialchars(trim($_POST['nom'])),
        'prenom' => htmlspecialchars(trim($_POST['prenom'])),
        'email' => htmlspecialchars(trim($_POST['email'])),
        'telephone' => intval($_POST['telephone']),
        'adresse' => htmlspecialchars(trim($_POST['adresse'])),
    ];

    $formDataNouveauCahier = [
        'secteur_activite' => htmlspecialchars(trim($_POST['secteur_activite'])),
        'nom_entreprise' => htmlspecialchars(trim($_POST['nom_entreprise'])),
        'email_entreprise' => htmlspecialchars(trim($_POST['email_entreprise'])),
        'telephone_entreprise' => intval($_POST['telephone_entreprise']),
        'adresse_entreprise' => htmlspecialchars(trim($_POST['adresse_entreprise'])),
        'secteur_entreprise' => htmlspecialchars(trim($_POST['secteur_entreprise'])),
        'type_site' => htmlspecialchars(trim($_POST['type_site'])),
        'nombre_couleurs' => intval($_POST['nombre_couleurs']),
        'couleur1' => htmlspecialchars(trim($_POST['couleur1'])),
        'couleur2' => htmlspecialchars(trim($_POST['couleur2'])),
        'couleur3' => htmlspecialchars(trim($_POST['couleur3'])),
        'logo' => isset($_POST['logo']) ? 1 : 0,
        'logo_file' => '',
        'message_entreprise' => htmlspecialchars(trim($_POST['message_entreprise'])),
        'header_desktop' => htmlspecialchars(trim($_POST['header_desktop'])),
        'header_mobile' => htmlspecialchars(trim($_POST['header_mobile'])),
        'footer_desktop' => htmlspecialchars(trim($_POST['footer_desktop'])),
    ];

    // Vérifier si le logo doit être mis à jour
    if (isset($_POST['logo']) && $_POST['logo'] === 'oui') {
        $logoFile = $_FILES['logo_file'];

        if (!empty($logoFile['name'])) {
            // Vérifier le type de fichier
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($logoFile['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                $formErrors['logo-file'] = 'Le format du logo doit être JPG, JPEG, PNG ou GIF.';
            } else {
                // Renommer le fichier avec le pseudo du client
                $pseudo_client = $formDataClient['nom'] . '_' . $formDataClient['prenom'];
                $newLogoName = hash('sha256', $pseudo_client . $logoFile['name']) . '.' . $fileExtension;
                $uploadPath =  './Public/uploads/' . $newLogoName;

                // Déplacer le fichier vers le dossier uploads
                if (!move_uploaded_file($logoFile['tmp_name'], $uploadPath)) {
                    $formErrors['logo-file'] = 'Une erreur est survenue lors du téléchargement du logo.';
                } else {
                    // Le chemin du fichier pour enregistrement dans la base de données
                    $formDataNouveauCahier['logo_file'] = $uploadPath;
                }
            }
        } else {
            $formErrors['logo-file'] = 'Veuillez télécharger votre logo.';
        }
    }

    // Effectuer les mises à jour dans la base de données si aucun champ n'est vide
    if (
        !empty($formDataClient['nom']) && !empty($formDataClient['prenom']) && !empty($formDataClient['email']) &&
        !empty($formDataClient['telephone']) && !empty($formDataClient['adresse']) &&
        !empty($formDataNouveauCahier['secteur_activite']) && !empty($formDataNouveauCahier['nom_entreprise']) &&
        !empty($formDataNouveauCahier['email_entreprise']) && !empty($formDataNouveauCahier['telephone_entreprise']) &&
        !empty($formDataNouveauCahier['adresse_entreprise']) && !empty($formDataNouveauCahier['secteur_entreprise']) &&
        !empty($formDataNouveauCahier['type_site']) && !empty($formDataNouveauCahier['nombre_couleurs']) &&
        !empty($formDataNouveauCahier['couleur1']) && !empty($formDataNouveauCahier['couleur2']) &&
        !empty($formDataNouveauCahier['couleur3']) && !empty($formDataNouveauCahier['message_entreprise']) &&
        !empty($formDataNouveauCahier['header_desktop']) && !empty($formDataNouveauCahier['header_mobile']) &&
        !empty($formDataNouveauCahier['footer_desktop'])
    ) {
        // Vérifier si $_SESSION['admin_id'] est défini, sinon rediriger vers la page appropriée
        if (isset($_SESSION['admin_id'])) {
            try {
                $adminModel = new AdminModel();
                $conn = $adminModel->getConnexion();

                // Mettre à jour les données dans la table clients
                $clientId = intval($_POST['client_id']);
                $resultClient = $adminModel->updateClient($clientId, $formDataClient);

                // Mettre à jour les données dans la table nouveau_cahier
                $nouveauCahierId = intval($_POST['id']);
                $resultNouveauCahier = $adminModel->updateNouveauCahier($nouveauCahierId, $formDataNouveauCahier);

                // Vérifier les résultats
                if ($resultClient && $resultNouveauCahier) {
                    // Mises à jour réussies
                    header('Location: http://localhost/MSC-1/admin_dashboard');
                    exit;
                } else {
                    // Erreur lors de la mise à jour
                    $errorInfoClient = $stmtClient->errorInfo();
                    $errorInfoNouveauCahier = $stmtNouveauCahier->errorInfo();
                    echo "Erreur lors de la mise à jour : " . $errorInfoClient[2] . " / " . $errorInfoNouveauCahier[2];
                    exit;
                }
            } catch (PDOException $e) {
                // Erreur lors de la préparation de la mise à jour
                echo "Erreur lors de la préparation de la mise à jour : " . $e->getMessage();
                exit;
            }
        } else {
            // Rediriger vers la page de connexion si l'administrateur n'est pas connecté
            header('Location: http://localhost/MSC-1/admin_login');
            exit;
        }
    }
}

?>

<div class="container">
    <h1>Gestion des Clients et Nouveau Cahier</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Profession</th>
                <th>Secteur d'activité</th>
                <th>Nom de l'entreprise</th>
                <th>Email de l'entreprise</th>
                <th>Téléphone de l'entreprise</th>
                <th>Adresse de l'entreprise</th>
                <th>Secteur de l'entreprise</th>
                <th>Type de site</th>
                <th>Nombre de couleurs</th>
                <th>Couleur 1</th>
                <th>Couleur 2</th>
                <th>Couleur 3</th>
                <th>Logo</th>
                <th>Message de l'entreprise</th>
                <th>Header Desktop</th>
                <th>Header Mobile</th>
                <th>Footer Desktop</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $adminModel = new AdminModel();
            $clientsAndNouveauCahiers = $adminModel->getClientsAndNouveauCahiers();
            foreach ($clientsAndNouveauCahiers as $data) : ?>
                <tr>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="client_id" value="<?= $data['id'] ?>">
                        <input type="hidden" name="id" value="<?= $data['nouveau_cahier_id'] ?>">
                        <td><input type="text" name="nom" value="<?= $data['nom'] ?>"></td>
                        <td><input type="text" name="prenom" value="<?= $data['prenom'] ?>"></td>
                        <td><input type="text" name="email" value="<?= $data['email'] ?>"></td>
                        <td><input type="text" name="telephone" value="<?= $data['telephone'] ?>"></td>
                        <td><input type="text" name="adresse" value="<?= $data['adresse'] ?>"></td>
                        <td><input type="text" name="profession" value="<?= $data['profession'] ?>"></td>
                        <td><input type="text" name="secteur_activite" value="<?= $data['secteur_activite'] ?>"></td>
                        <td><input type="text" name="nom_entreprise" value="<?= $data['nom_entreprise'] ?>"></td>
                        <td><input type="text" name="email_entreprise" value="<?= $data['email_entreprise'] ?>"></td>
                        <td><input type="text" name="telephone_entreprise" value="<?= $data['telephone_entreprise'] ?>"></td>
                        <td><input type="text" name="adresse_entreprise" value="<?= $data['adresse_entreprise'] ?>"></td>
                        <td><input type="text" name="secteur_entreprise" value="<?= $data['secteur_entreprise'] ?>"></td>
                        <td><input type="text" name="type_site" value="<?= $data['type_site'] ?>"></td>
                        <td><input type="number" name="nombre_couleurs" value="<?= $data['nombre_couleurs'] ?>"></td>
                        <td><input type="color" name="couleur1" value="<?= $data['couleur1'] ?>"></td>
                        <td><input type="color" name="couleur2" value="<?= $data['couleur2'] ?>"></td>
                        <td><input type="color" name="couleur3" value="<?= $data['couleur3'] ?>"></td>
                        <td>
                            <?php if ($data['logo_file']) : ?>
                                <img src="<?= $data['logo_file'] ?>" alt="Logo" style="max-height: 50px;">
                            <?php else : ?>
                                Pas de logo
                            <?php endif; ?>
                            <input type="checkbox" name="logo" value="oui"> Mettre à jour le logo
                            <input type="file" name="logo_file" accept="image/*">
                        </td>
                        <td><input type="text" name="message_entreprise" value="<?= $data['message_entreprise'] ?>"></td>
                        <td><input type="text" name="header_desktop" value="<?= $data['header_desktop'] ?>"></td>
                        <td><input type="text" name="header_mobile" value="<?= $data['header_mobile'] ?>"></td>
                        <td><input type="text" name="footer_desktop" value="<?= $data['footer_desktop'] ?>"></td>
                        <td><button type="submit" class="btn btn-primary">Modifier</button></td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>