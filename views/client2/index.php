<!-- Include header et footer-->
<?php
include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
?>

<!-- Session start-->
<?php

session_start();
$_SESSION['currentStep'] = 1;
require_once ROOT . 'App/Model.php';

class ClientModel extends Model
{
    public function insertClient($typesite, $nombreCouleurs, $couleur1, $couleur2, $couleur3)
    {
        $sql = "INSERT INTO sites (type_site, nombre_couleur, couleur1, couleur2, couleur3) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$typesite, $nombreCouleurs, $couleur1, $couleur2, $couleur3]);
    }
}

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
            $clientModel->insertClient($typesite, $nombreCouleurs, $couleur1, $couleur2, $couleur3);

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
?>



<div class="container formulaire">

    <div class="container text-center mt-4 mb-5">
        <h1>Suite du formulaire</h1>
        <h2>Entrez les différentes informations pour un site plus personnel</h2>
    </div>
    <ul class="progressbar">
        <li <?php if ($_SESSION['currentStep'] == 1) {
                echo 'class="active"';
            } ?>><img src="./Public/asset/svg/one.svg" class="logo_previous_progress"></li>
        <li class="progressed"> -----✔️----- </li>
        <li <?php if ($_SESSION['currentStep'] == 2) {
                echo 'class="active"';
            } ?>><a href=<?php ROOT . "views/client2" ?>><img src="./Public/asset/svg/two.svg" class="logo_previous_progress"></a></li>
        <li class="progressed"> ------✔️----- </li>
        <li <?php if ($_SESSION['currentStep'] == 3) {
                echo 'class="active"';
            } ?>><a href=<?php ROOT . "views/client3" ?>><img src="./Public/asset/svg/three.svg" class="logo_current_progress"></a></li>
        <li class="in_progress"> ------🚧----- </li>
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

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="">

            <!-- Type de site -->
                <div class="form-group mb-5">
                    <label class="mb-2" for="type_site">Quel type de site souhaitez-vous?</label><br>
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

            <!-- Selection de couleur -->
                <div class="form-group mb-3">
                    <label class="mb-2" for="nombre-couleurs">Faites glisser la barre ci-dessous pour choisir le nombre et les couleurs de votre site</label>
                    <input type="range" class="form-range" name="nombre-couleurs" id="nombre-couleurs" min="0" max="3" value="0"oninput="showColorFields()">

                </div>

            <!-- Nombre de couleur variable-->
                    <div class="container d-flex justify-content-center text-center">
                    <?php for ($i = 1; $i <= 3; $i++) { ?>
                            <div class="row mx-2">
                                
                                    <div class="form-group" id="label-couleur<?php echo $i; ?>" style="display: none;">
                                        <label class="mb-2 color_title" id="lblclr" for="couleur<?php echo $i; ?>">Couleur <?php echo ($i == 1) ? 'principale' : (($i == 2) ? 'secondaire' : 'tertiaire'); ?></label>   
                                    </div>
                                    <div class="form-group">
                                        <input type="text" data-coloris name="couleur<?php echo $i; ?>" id="couleur<?php echo $i; ?>" style="display: none;">
                                    
                                     
                                    </div>
                                    
                            </div>
                            
                            <?php } ?>
                        </div>
               
                    
                <div class="row p-2">
                    <button type="submit" class="btn my-3">Étape suivante -></button>
                </div>


                        <?php
                        var_dump($_POST);
                        ?>
            </form>
        </div>
    </div>
</div>


<script src="./Public/js/color_logo_form.js"></script>
<script src="./Public/js/coloris.min.js"></script>

<!--

<script>
function addEventListenerToColorField(couleurField, index) {
    couleurField.addEventListener("change", function() {
        console.log("Couleur " + index + " : " + this.value);
        document.getElementById("couleur" + index + "_hidden").value = this.value;
    });
}

function addEventListenersToColors() {
    for (var i = 1; i <= 3; i++) {
        var couleurField = document.getElementById("couleur" + i);
        addEventListenerToColorField(couleurField, i);
    }
}

addEventListenersToColors();

</script>

-->

