<?php
include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';    
require_once ROOT . 'App/Model.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: http://localhost/MSC-1/adminlogin');
    exit;
}

class AdminModel extends Model
{
    public function getAllClients()
    {
        $sql = "SELECT * FROM clients";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllNouveauCahiers()
    {
        $sql = "SELECT * FROM nouveau_cahier";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les nouveaux cahiers associés à un client
    public function getNouveauCahiersByClientId($clientId)
    {
        $sql = "SELECT * FROM nouveau_cahier WHERE client_id = :client_id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':client_id', $clientId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour les données d'un client
    public function updateClient($clientId, $data)
    {
        $sql = "UPDATE clients SET nom = :nom, prenom = :prenom, pseudo = :pseudo, email = :email WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':pseudo', $data['pseudo']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':id', $clientId);
        return $stmt->execute();
    }

    // Méthode pour mettre à jour les données d'un nouveau cahier
    public function updateNouveauCahier($cahierId, $data)
    {
        $sql = "UPDATE nouveau_cahier SET secteur_activite = :secteur_activite, nom_entreprise = :nom_entreprise WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':secteur_activite', $data['secteur_activite']);
        $stmt->bindParam(':nom_entreprise', $data['nom_entreprise']);
        $stmt->bindParam(':id', $cahierId);
        return $stmt->execute();
    }

    // Méthode pour supprimer un client et ses données associées
    public function deleteClient($clientId)
    {
        // Logique pour supprimer les données associées du client (par exemple, les cahiers liés)
        // Ensuite, supprimez le client lui-même
        $sql = "DELETE FROM clients WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':id', $clientId);
        return $stmt->execute();
    }

    // Autres méthodes si nécessaire
}

$adminModel = new AdminModel();
$adminModel->getConnexion();

$clients = $adminModel->getAllClients();
$nouveauxCahiers = $adminModel->getAllNouveauCahiers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'modifier_client') {
        $clientId = $_POST['client_id'];
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $pseudo = htmlspecialchars(trim($_POST['pseudo']));
        $email = htmlspecialchars(trim($_POST['email']));

        $data = [
            'nom' => $nom,
            'prenom' => $prenom,
            'pseudo' => $pseudo,
            'email' => $email,
        ];
        $adminModel->updateClient($clientId, $data);
    } elseif ($_POST['action'] === 'modifier_cahier') {
        $cahierId = $_POST['cahier_id'];
        $secteur_activite = htmlspecialchars(trim($_POST['secteur_activite']));
        $nom_entreprise = htmlspecialchars(trim($_POST['nom_entreprise']));
        // Ajoutez ici la validation des données du formulaire de modification pour le cahier

        $data = [
            'secteur_activite' => $secteur_activite,
            'nom_entreprise' => $nom_entreprise,
            // Ajoutez ici les autres champs du cahier à mettre à jour
        ];
        $adminModel->updateNouveauCahier($cahierId, $data);
    } elseif ($_POST['action'] === 'supprimer_client') {
        $clientId = $_POST['client_id'];
        $adminModel->deleteClient($clientId);
      
    }
}
?>
<!-- Page admin -->
<div class="container formulaire">
    <div class="row">
        <h1>Admin Page</h1>
        <div class="col-lg-12">
            <h2>Clients</h2>
            <div class="table-responsive">
                <table class="table table-bordered text-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($clients as $client) : ?>
                        <tr>
                            <td><?= $client['id'] ?></td>
                            <td><?= $client['nom'] ?></td>
                            <td><?= $client['prenom'] ?></td>
                            <td><?= $client['pseudo'] ?></td>
                            <td><?= $client['email'] ?></td>
                            <td>
                                <button type="button" class="btn btn-info" onclick="toggleNouveauxCahiers(<?= $client['id'] ?>)">Afficher</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifierClientModal<?= $client['id'] ?>">Modifier</button>
                                <form method="post" style="display: inline-block;">
                                    <input type="hidden" name="client_id" value="<?= $client['id'] ?>">
                                    <input type="submit" name="action" value="supprimer_client" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce client?');">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- Tableau des nouveaux cahiers -->
    <?php foreach ($clients as $client) : ?>
        <div class="col-lg-6">
            <h2>Cahiers associés au client <?= $client['id'] ?></h2>
            <div class="table-responsive" id="cahiers_client_<?= $client['id'] ?>" style="display: none;">
                <table class="table table-bordered text-light">
                    <tr>
                        <th>Profession</th>
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
                        <th>Fichier logo</th>
                        <th>Message de l'entreprise</th>
                        <th>Header desktop</th>
                        <th>Header mobile</th>
                        <th>Footer desktop</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($nouveauxCahiers as $cahier) : ?>
                        <?php if ($cahier['client_id'] == $client['id']) : ?>
                            <tr>
                                <td><?= $cahier['profession'] ?></td>
                                <td><?= $cahier['nom_entreprise'] ?></td>
                                <td><?= $cahier['email_entreprise'] ?></td>
                                <td><?= $cahier['telephone_entreprise'] ?></td>
                                <td><?= $cahier['adresse_entreprise'] ?></td>
                                <td><?= $cahier['secteur_entreprise'] ?></td>
                                <td><?= $cahier['type_site'] ?></td>
                                <td><?= $cahier['nombre_couleurs'] ?></td>
                                <td><?= $cahier['couleur1'] ?></td>
                                <td><?= $cahier['couleur2'] ?></td>
                                <td><?= $cahier['couleur3'] ?></td>
                                <td><?= $cahier['logo'] ?></td>
                                <td><?= $cahier['logo_file'] ?></td>
                                <td><?= $cahier['message_entreprise'] ?></td>
                                <td><?= $cahier['header_desktop'] ?></td>
                                <td><?= $cahier['header_mobile'] ?></td>
                                <td><?= $cahier['footer_desktop'] ?></td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifierCahierModal<?= $cahier['id'] ?>">Modifier</button>
                                    <form method="post" style="display: inline-block;">
                                        <input type="hidden" name="cahier_id" value="<?= $cahier['id'] ?>">
                                        <input type="submit" name="action" value="supprimer_cahier" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce cahier?');">
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modals pour modifier le client -->
<?php foreach ($clients as $client) : ?>
    <div class="modal fade" id="modifierClientModal<?= $client['id'] ?>" tabindex="-1" aria-labelledby="modifierClientModalLabel<?= $client['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifierClientModalLabel<?= $client['id'] ?>">Modifier le client <?= $client['id'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" name="client_id" value="<?= $client['id'] ?>">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= $client['nom'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $client['prenom'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $client['pseudo'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $client['email'] ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="action" value="modifier_client" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modals pour modifier le cahier -->
<?php foreach ($nouveauxCahiers as $cahier) : ?>
    <div class="modal fade" id="modifierCahierModal<?= $cahier['id'] ?>" tabindex="-1" aria-labelledby="modifierCahierModalLabel<?= $cahier['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifierCahierModalLabel<?= $cahier['id'] ?>">Modifier le cahier <?= $cahier['id'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" name="cahier_id" value="<?= $cahier['id'] ?>">
                        <div class="mb-3">
                            <label for="secteur_activite" class="form-label">Secteur d'activité</label>
                            <input type="text" class="form-control" id="secteur_activite" name="secteur_activite" value="<?= $cahier['secteur_activite'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nom_entreprise" class="form-label">Nom de l'entreprise</label>
                            <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" value="<?= $cahier['nom_entreprise'] ?>">
                        </div>
                        <!-- Ajouter ici tous les autres champs du cahier à modifier -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="action" value="modifier_cahier" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    function toggleNouveauxCahiers(clientId) {
        const tableId = 'cahiers_client_' + clientId;
        const tableElement = document.getElementById(tableId);
        tableElement.style.display = (tableElement.style.display === 'none') ? 'table' : 'none';
    }
    <?php if (isset($_POST['action']) && ($_POST['action'] == 'modifier_client' || $_POST['action'] == 'modifier_cahier')) : ?>
        window.location.reload();
    <?php endif; ?>
</script>