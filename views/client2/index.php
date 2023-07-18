<!-- Include header et footer-->
<?php
include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
?>

<!-- Session start-->
<?php
session_start();
$_SESSION['currentStep'] = 2;
/// Connexion BDD
require_once ROOT . '/App/Model.php';

/// Insertion info BDD
class ClientModel extends Model
{
    public function insertSiteInformation($nombreCouleurs, $couleurs, $logo)
    {
        $sql = "INSERT INTO clients (nombre_couleurs, couleur1, couleur2, couleur3, logo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$nombreCouleurs, $couleurs[0], $couleurs[1], $couleurs[2], $logo]);
    }
}

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientModel = new ClientModel();
    $clientModel->getConnexion();

    $nombreCouleurs = $_POST['nombre-couleurs'];
    $couleurs = array();

    // Récupérer les valeurs des couleurs
    for ($i = 1; $i <= $nombreCouleurs; $i++) {
        $couleur = $_POST['couleur' . $i];
        $couleurs[] = $couleur;
    }

    $logo = isset($_POST['logo']) ? $_POST['logo'] : '';

    $clientModel->insertSiteInformation($nombreCouleurs, $couleurs, $logo);


    header("Location: http://localhost/MSC-1/client3");
    exit();
}
?>

<?php
echo "<p>Bienvenue " . $_SESSION['nom'] . " " . $_SESSION['prenom'] . " Vous avez un projet de site internet ? Renseignez vos informations nous nous occupons du reste.</p>";
?>
<div class="container formulaire">

    <div class="container text-center mt-4 mb-5">
        <h1>Suite du formulaire</h1>
        <h2>Entrez les différentes informations pour un site plus personnel</h2>
    </div>
    <ul class="progressbar">
    <li <?php if ($_SESSION['currentStep'] == 1) { echo 'class="active"'; } ?>><img src="./Public/asset/svg/one.svg" class="logo_previous_progress"></li>
    <li class="progressed"> -----✔️----- </li>        
    <li <?php if ($_SESSION['currentStep'] == 2) { echo 'class="active"'; } ?>><a href=<?php ROOT . "views/client2"?> ><img src="./Public/asset/svg/two.svg" class="logo_previous_progress"></a></li>
    <li class="progressed"> ------✔️----- </li>        
    <li <?php if ($_SESSION['currentStep'] == 3) { echo 'class="active"'; } ?>><a href=<?php ROOT . "views/client3"?> ><img src="./Public/asset/svg/three.svg" class="logo_current_progress"></a></li>
    <li class="in_progress"> ------🚧----- </li>       
    <li <?php if ($_SESSION['currentStep'] == 4) { echo 'class="active"'; } ?>><a href=<?php ROOT . "views/client4"?> ><img src="./Public/asset/svg/four.svg" class="logo_progress"></a></li>
    <li class="in_progress"> ----------- </li>        
    <li <?php if ($_SESSION['currentStep'] == 5) { echo 'class="active"'; } ?>><a href=<?php ROOT . "views/client5"?> ><img src="./Public/asset/svg/five.svg" class="logo_progress"></a></li>
    <li class="in_progress"> ----------- </li>         
    <li <?php if ($_SESSION['currentStep'] == 6) { echo 'class="active"'; } ?>><a href=<?php ROOT . "views/client6"?> ><img src="./Public/asset/svg/six.svg" class="logo_progress"></a></li>
        </ul>
        
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="">
            <div class="form-group mb-5">
                    <label for="pet-select">Quel type de site souhaitez-vous?</label><br>
                    <select name="type_site" id="type_site" class="form-select-sm" required>
                        <option value="">Choisissez une option</option>
                        <option value="vitrine">Site Vitrine</option>
                        <option value="e-commerce">E-commerce</option>
                        <option value="portfolio">Portfolio</option>
                        <option value="annnonce">Site d'annonce</option>
                        <option value="association">Site pour association</option>
                        <option value="agence-immo">Site pour agence immobilière</option>
                    </select>
            </div>
                <div class="form-group mb-3">
                    <label for="nombre-couleurs">Faites glisser la barre ci-dessous pour choisir le nombre et les couleurs de votre site</label>
                    <input type="range" class="form-range" name="nombre-couleurs" id="nombre-couleurs" min="0" max="3" value="0"oninput="showColorFields()">

                </div>

                <div class="color_form">
                    <div class="container d-flex justify-content-center text-center">
                    <?php for ($i = 1; $i <= 3; $i++) { ?>
                            <div class="row mx-2">
                                
                                    <div class="form-group" id="label-couleur<?php echo $i; ?>" style="display: none;">
                                        <label class="mb-2"for="couleur<?php echo $i; ?>">Couleur <?php echo ($i == 1) ? 'principale' : (($i == 2) ? 'secondaire' : 'tertiaire'); ?></label>   
                                    </div>
                                    <div class="form-group">
                                        <input type="text" data-coloris name="couleur<?php echo $i; ?>" id="couleur<?php echo $i; ?>" style="display: none;">
                                    </div>
                                    
                            </div>
                            
                            <?php } ?>
                        </div>
                </div>
                
                <div class="row p-2">
                    <button type="submit" class="btn my-3">Étape suivante -></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="./Public/js/coloris.min.js"></script>
<script src="./Public/js/progress.js"></script>
<script src="./Public/js/formulaire.js"></script>
