<?php
session_start();

// Inclure les fichiers d'en-tête et de pied de page
include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';
require_once ROOT . 'App/Model.php';
require_once ROOT . 'Public/php/traitement-formulaire1.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link href="./Public/css/main.css" rel="stylesheet" type="text/css">
<link href="./Public/css/coloris.min.css" rel="stylesheet" />
<div class="container formulaire">
    <form method="post" action="">

        <!-- Formulaire 1-->
        <div id="formulaire1" class="container ">
            <div class="row">

                <div class="container text-center mt-4">
                    <h1 class="mb-5">Création de votre site</h1>
                </div>

                <ul class="progressbar">
                    <li <?php if ($_SESSION['currentStep'] == 1) {
                        echo 'class="active"';
                    } ?>><img       src="./Public/asset/svg/one.svg" class="logo_current_progress"></li>
                    <li class="in_progress"> -----🚧----- </li>
                    <li <?php if ($_SESSION['currentStep'] == 2) {
                        echo 'class="active"';
                    } ?>><img src="./Public/asset/svg/two.svg" class="logo_progress"></a></li>
                    <li class="in_progress"> ----------- </li>
                    <li <?php if ($_SESSION['currentStep'] == 3) {
                        echo 'class="active"';
                    } ?>><img src="./Public/asset/svg/three.svg" class="logo_progress"></a></li>
                    <li class="in_progress"> ----------- </li>
                    <li <?php if ($_SESSION['currentStep'] == 4) {
                        echo 'class="active"';
                    } ?>><img src="./Public/asset/svg/four.svg" class="logo_progress"></a></li>
                    <li class="in_progress"> ----------- </li>
                    <li <?php if ($_SESSION['currentStep'] == 5) {
                        echo 'class="active"';
                    } ?>><img src="./Public/asset/svg/five.svg" class="logo_progress"></a></li>
                    <li class="in_progress"> ----------- </li>
                    <li <?php if ($_SESSION['currentStep'] == 6) {
                        echo 'class="active"';
                    } ?>><img src="./Public/asset/svg/six.svg" class="logo_progress"></a></li>
                </ul>

                <div class="container">

                    <!-- Container formulaire-->
                    <div class="row justify-content-center">

                        <div class="col-md-8">
                            <p class="text-center mb-5">Vous avez un projet de site internet ? Renseignez vos
                                informations nous nous occupons du reste.</p>
                            <!-- Formulaire -->


                            <!-- Nom et prénom -->
                            <div class="row my-3">

                                <!-- Nom-->
                                <div class="col-6">
                                    <div class="form-group ">


                                        <label for="nom">Nom :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>

                                    </div>
                                </div>

                                <!-- Prénom-->
                                <div class="col-6">
                                    <div class="form-group ">

                                        <label for="prenom">Prénom :</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" required>

                                    </div>
                                </div>
                            </div>

                            <!-- Adresse email -->
                            <div class="form-group my-3">
                                <label for="email">Adresse email :</label>
                                <input type="email" class="form-control" id="email" name="email" required">
                            </div>

                            <!-- Numéro de téléphone -->
                            <div class="form-group my-3">
                                <label for="telephone">Numéro de téléphone :</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" required>
                            </div>

                            <!-- Adresse postale -->
                            <div class="form-group my-3">
                                <label for="adresse">Adresse postale :</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" required>
                            </div>


                            <!-- Profession + Secteur d'activité -->
                            <div class="row">

                                <!-- Profession -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="profession">Profession :</label>
                                        <input type="text" class="form-control" id="profession" name="profession"
                                            required>
                                    </div>

                                </div>

                                <!-- Secteur d'activité-->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="secteur">Secteur d'activité :</label>
                                        <input type="text" class="form-control" id="secteur" name="secteur_activite" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-2">
                                <button type="button" id="formulaire1_btn" class="btn my-3">Passer à l'étape suivante</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire 2-->
        <div id="formulaire2" class="container d-none">

            <div class="container text-center mt-4 mb-5">
                <h1 class="mb-4">Information concernant votre entreprise</h1>
                <p>
                    Veuillez rentrer les informations concernant votre
                    entreprise afin de faciliter la création de votre site.
                </p>
            </div>
            <ul class="progressbar">
                <li <?php if ($_SESSION['currentStep'] == 1) {
                    echo 'class="active"';
                } ?>><img       src="./Public/asset/svg/one.svg" class="logo_previous_progress"></li>
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


                        <!-- Nom -->
                        <div class="container">
                            <div class="row my-3">
                                <div class="col-6">
                                    <div class="form-group ">

                                        <label for="nom_ent">Nom commercial</label>
                                        <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" required>


                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="col-6">
                                    <div class="form-group">

                                        <label for="prenom_ent">Adresse email :</label>
                                        <input type="email" class="form-control" id="email_entreprise" name="email_entreprise"
                                            required>


                                    </div>
                                </div>
                            </div>

                            <!-- Adresse -->
                            <div class="row">
                                <div class="form-group my-3 col-6">
                                    <label for="adresse_ent">Adresse postale :</label>
                                    <input type="text" class="form-control" id="adresse_entreprise" name="adresse_entreprise"
                                        required">
                                </div>

                                <!-- Numéro de téléphone -->
                                <div class="form-group my-3 col-6">
                                    <label for="telephone_ent">Numéro de téléphone :</label>
                                    <input type="tel" class="form-control" id="telephone_entreprise" name="telephone_entreprise"
                                        required>
                                </div>
                            </div>

                            <div class="form-group my-3 col-6">
                                <label for="secteur_entreprise">Secteur d'activité :</label>
                                <input type="text" class="form-control" id="secteur_entreprise" name="secteur_entreprise" required>
                            </div>

                            <div class="row p-2">
                                <button type="button" id="formulaire2_btn" class="btn my-3">Passer à l'étape suivante</button>
                            </div>
                        </div>

                        <div>
                            <?php
                            var_dump($_POST);
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire 3-->
        <div id="formulaire3" class="container d-none ">

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
                } ?>><a href=<?php ROOT . "views/client2" ?>><img src="./Public/asset/svg/two.svg" class="logo_previous_progress"></a>
                </li>
                <li class="progressed"> ------✔️----- </li>
                <li <?php if ($_SESSION['currentStep'] == 3) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client3" ?>><img src="./Public/asset/svg/three.svg" class="logo_current_progress"></a>
                </li>
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
                    <div class="form-group mb-4">
                        <label class="mb-2" for="nombre-couleurs">Faites glisser la barre ci-dessous pour choisir le
                            nombre et les couleurs de votre site</label>
                        <input type="range" class="form-range" name="nombre_couleurs" id="nombre-couleurs" min="0"
                            max="3" value="0" oninput="showColorFields()">

                    </div>

                    <!-- Nombre de couleur variable-->
                    <div class="container d-flex justify-content-center text-center">
                        <?php for ($i = 1; $i <= 3; $i++) { ?>
                            <div class="row mx-2">

                                <div class="form-group mb-3" id="label_couleur_div<?php echo $i; ?>" style="display: none;">
                                    <label class="color_title" id="label_couleur<?php echo $i; ?>"
                                        for="couleur<?php echo $i; ?>">Couleur <?php echo ($i == 1) ? 'principale' : (($i == 2) ? 'secondaire' : 'tertiaire'); ?></label>
                                </div>
                                <div class="form-group mb-5">
                                    <input type="text" data-coloris name="couleur<?php echo $i; ?>"
                                        id="couleur<?php echo $i; ?>" style="display: none;">

                                </div>

                            </div>

                        <?php } ?>
                    </div>

                    <!-- Logo-->
                    <div class="row align-items-center">
                        <div class="col-7">
                            <div class="form-group" required>
                                <label for="logo">Avez-vous un logo ?</label>
                                <input type="radio" name="logo" id="logo_oui" value="oui"
                                    onclick="showLogoFields(); logoSelectionValidate()" required>
                                <label id="logo_label_oui" class="btn" for="logo_oui">Oui</label>
                                <input type="radio" name="logo" id="logo_non" value="non"
                                    onclick="showLogoFields(); logoSelectionValidate()" required>
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
                            <p>⚠️ Le logo étant nécessaire, une proposition vous sera faites afin de vous créer un
                                logo personnalisé ⚠️</p>
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
                        <label class="mb-2" for="message_ent">Parlez-nous un peu plus de votre entreprise (Les
                            services que vous proposez, ce que vendez ou créez etc..) :</label>
                        <textarea class="form-control" name="message_entreprise" id="message_entreprise" rows="12"
                            required></textarea>
                    </div>

                    <div class="row p-2">
                        <button type="button" id="formulaire3_btn" class="btn my-3">Passer à l'étape suivante</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Formulaire 4-->
        <div id="formulaire4" class="container d-none">
            <div class="container text-center mt-4 mb-5">
                <h1>Suite du formulaire</h1>
                <h2>Entrez les différentes informations pour un site plus personnel</h2>
            </div>

            <ul class="progressbar">
                <li <?php if ($_SESSION['currentStep'] == 1) {
                    echo 'class="active"';
                } ?>><img   src="./Public/asset/svg/one.svg" class="logo_previous_progress"></li>
                <li class="progressed"> ------✔️----- </li>
                <li <?php if ($_SESSION['currentStep'] == 2) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client2" ?>><img src="./Public/asset/svg/two.svg" class="logo_previous_progress"></a>
                </li>
                <li class="progressed"> ------✔️----- </li>
                <li <?php if ($_SESSION['currentStep'] == 3) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client3" ?>><img src="./Public/asset/svg/three.svg" class="logo_previous_progress"></a>
                </li>
                <li class="progressed"> ------✔️----- </li>
                <li <?php if ($_SESSION['currentStep'] == 4) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client4" ?>><img src="./Public/asset/svg/four.svg" class="logo_current_progress"></a>
                </li>
                <li class="in_progress"> ------🚧----- </li>
                <li <?php if ($_SESSION['currentStep'] == 5) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client5" ?>><img src="./Public/asset/svg/five.svg" class="logo_progress"></a></li>
                <li class="in_progress"> ----------- </li>
                <li <?php if ($_SESSION['currentStep'] == 6) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client6" ?>><img src="./Public/asset/svg/six.svg" class="logo_progress"></a></li>
            </ul>




            <!-- Header ordinateur-->
            <div class="row mb-3" id="header_desktop_div">
                <div class="col-3 p-5">
                    <p>
                        <button class="btn" id="header_desktop_btn" type="button"
                            onclick="desktopMenuDisplay();setTimeout(() => { window.scrollTo(0,250);}, 230);">
                            Selectionnez votre header sur ordinateur
                        </button>
                    </p>
                </div>

                <div class="col-6 d-none justify-content-center p-5 text-center" id="header_desktop_preview">
                    <img id="header_desktop_preview_img" src="">
                </div>

                <div class="col-6 d-none" id="header_desktop_selection_display" style="min-height: 120px;">
                    <div class="collapse collapse-horizontal" id="collapseHeader">
                        <div class="card card-body" id="header_desktop_card">

                            <?php
                            $imageFolder = "./Public/asset/image/";

                            for ($i = 1; $i <= 6; $i++) {
                                $image1Name = "frameh" . $i . ".svg";
                                $image1Path = $imageFolder . $image1Name;

                                // Affichage des 3 dernières images dans une div séparée
                            
                                echo '<div class="container header_desktop">';
                                echo '<div class="row">';

                                echo '<label for="header' . $i . '">';
                                echo '<input type="radio" class="form-check-input header_input" id="header' . $i . '" name="header_desktop" value="' . $image1Path . '">';
                                echo '<img class="headerTaille img-fluid" src="' . $image1Path . '" alt="Header ' . $i . '">';
                                echo '</label>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Header mobile -->
            <div class="row d-none" id="header_mobile_div">
                <div class="col-3 p-5">
                    <p>
                        <button class="btn btn-primary" id="header_mobile_btn" type="button"
                            onclick="mobileMenuDisplay()">
                            Selectionnez l'affichage sur mobile et tablette
                        </button>
                    </p>
                </div>


                <div class="col-6 d-none justify_content_center text-center" id="header_mobile_preview">
                    <img id="header_mobile_preview_img" src="">
                </div>

                <div class="col-6 d-none" id="header_mobile_selection_display" style="min-height: 120px;">
                    <div class="collapse collapse-horizontal" id="collapseHeaderMobile">
                        <div class="card card-body" id="header_mobile_card">
                            <div class="row">
                                <?php
                                $imageFolder = "./Public/asset/image/";



                                for ($i = 7; $i <= 10; $i++) {
                                    $image1Name = "framehm" . $i . ".svg";
                                    $image1Path = $imageFolder . $image1Name;

                                    // Affichage des 3 dernières images dans une div séparée
                                





                                    echo '<label class="col-3" for="header_mobile' . $i . '">';
                                    echo '<input type="radio" class="form-check-input header_mobile_input"  id="header_mobile' . $i . '" name="header_mobile" value="' . $image1Path . '">';
                                    echo '<img class="headerMobileTaille img-fluid" src="' . $image1Path . '" alt="Header_mobile ' . $i . '">';
                                    echo '</label>';
                                }
                                ?>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="row p-2">
                <button type="button" id="formulaire4_btn" class="btn my-3">Passer à l'étape suivante</button>
            </div>



        </div>

        <!-- Formulaire 5-->
        <div id="formulaire5" class="container d-none">
            <div class="container text-center mt-4 mb-5">
                <h1>Suite du formulaire</h1>
                <h2>Entrez les différentes informations pour un site plus personnel</h2>
            </div>
            <ul class="progressbar">
                <li <?php if ($_SESSION['currentStep'] == 1) {
                    echo 'class="active"';
                } ?>><img               src="./Public/asset/svg/one.svg" class="logo_previous_progress"></li>
                <li class="progressed"> ------✔️----- </li>
                <li <?php if ($_SESSION['currentStep'] == 2) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client2" ?>><img src="./Public/asset/svg/two.svg" class="logo_previous_progress"></a>
                </li>
                <li class="progressed"> ------✔️----- </li>
                <li <?php if ($_SESSION['currentStep'] == 3) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client3" ?>><img src="./Public/asset/svg/three.svg" class="logo_previous_progress"></a>
                </li>
                <li class="progressed"> ------✔️----- </li>
                <li <?php if ($_SESSION['currentStep'] == 4) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client4" ?>><img src="./Public/asset/svg/four.svg" class="logo_previous_progress"></a>
                </li>
                <li class="progressed"> ------✔️----- </li>
                <li <?php if ($_SESSION['currentStep'] == 5) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client5" ?>><img src="./Public/asset/svg/five.svg" class="logo_current_progress"></a>
                </li>
                <li class="in_progress"> ------🚧----- </li>
                <li <?php if ($_SESSION['currentStep'] == 6) {
                    echo 'class="active"';
                } ?>><a href=<?php ROOT . "views/client6" ?>><img src="./Public/asset/svg/six.svg" class="logo_progress"></a></li>
            </ul>

            <h1>Suite du formulaire</h1>
            <h2>Choisissez un type de footer</h2>
            <div class="row">
                <div class="row">
                    <div class="row">
                        <?php

                        $imageFolder = "./Public/asset/image/";
                        for ($i = 1; $i <= 9; $i += 2) {
                            $image1Name = "framef" . $i . ".svg";
                            $image2Name = "framef" . ($i + 1) . ".svg";
                            $image1Path = $imageFolder . $image1Name;
                            $image2Path = $imageFolder . $image2Name;

                            echo '<div class="col-md-6">';
                            echo '<label for="footer' . $i . '">';
                            echo '<input type="radio" id="footer' . $i . '" name="footer_desktop" value="' . $image1Path . '">';
                            echo '<img class="footerTaille img-fluid" src="' . $image1Path . '" alt="Footer ' . $i . '">';
                            echo '</label>';

                            // Vérifie si l'image suivante existe
                            if (file_exists($image2Path)) {
                                echo '<label for="footer' . ($i + 1) . '">';
                                echo '<input type="radio" id="footer' . ($i + 1) . '" name="footer_desktop" value="' . $image2Path . '">';
                                echo '<img class="footerTaille img-fluid" src="' . $image2Path . '" alt="Footer ' . ($i + 1) . '">';
                                echo '</label>';
                            }

                            echo '</div>';
                        }
                        ?>



                    </div>
                </div>

            </div>

            <div class="row p-2">
                <button type="button" id="formulaire5_btn" class="btn my-3">Passer à l'étape suivante</button>
            </div>

        </div>

        <!-- Formulaire 6
        <div id="formulaire6" class="container">
    <div class="container text-center mt-4 mb-5">
        <h1>Choisissez votre palette de couleurs</h1>
        
                <div class="container row mt-5 mb-5">
                    <div class="color-palettes col-md-12 mt-5">
                        <?php
                        $colorPalettes = [
                            ['#293241', '#5A677D', '#98A6BD'],
                            ['#2E3830', '#7EA172', '#F2E8CF'],
                            ['#5C5E60', '#B4B7BA', '#FFFFFF'],
                            ['#483C67', '#6C5B7B', '#C06C84'],
                            ['#29335C', '#5373A3', '#E7EFF6'],
                            ['#3E363F', '#6D6875', '#D5E1DF'],
                            ['#FFFFFF', '#F98404', '#FF530D'],
                            ['#E63946', '#F1FAEE', '#A8DADC'],
                            ['#112D4E', '#3F72AF', '#DBE2EF'],
                            ['#5E60CE', '#7052A5', '#FFD700'],
                            ['#1B1725', '#465362', '#8D99AE'],
                            ['#22223B', '#4A4E69', '#9A8C98'],
                            ['#FF4C29', '#FFD152', '#F9ED69'],
                            ['#12263A', '#FF9933', '#FFD700'],
                            ['#424874', '#3D5A80', '#F4D35E']
                        ];

                        foreach ($colorPalettes as $index => $palette) {
                            echo '<div class="color-palette">';
                            echo '<input type="radio" id="palette' . $index . '" name="palette" value="' . $index . '">';
                            foreach ($palette as $color) {
                                echo '<div class="color" style="background-color: ' . $color . '"></div>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <?php
                    $imageFolder = "./Public/asset/image/";

                    for ($i = 1; $i <= 8; $i++) {
                        $image1Name = "body" . $i . ".svg";
                        $image1Path = $imageFolder . $image1Name;

                        // Affichage des 3 dernières images dans une div séparée
                        ?>
                    <div class="row">
                            <div class="col-md-12">
                            <?php
                            echo '<label for="body' . $i . '">';
                            echo '<input type="radio" id="body' . $i . '" name="body" value="' . $image1Path . '">';
                            echo '<img class="bodyTaille img-fluid" src="' . $image1Path . '" alt="body ' . $i . '">';
                            echo '</label>';
                    }
                    ?>
                            </div>
                    </div>
                </div>

                <div class="row p-2">
                    <button type="button" id="formulaire6_btn" class="btn my-3">Passer à l'étape suivante</button>
                </div>
            </div>

        
        </div> -->

        <div class="row p-2 d-none" id="form_btn">
            <button type="submit"  class="btn my-3">Envoyer le formulaire -></button>
        </div>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
<script src="./Public/js/progress.js"></script>
<script src="./Public/js/formulaire_event.js"></script>
<script src="./Public/js/header_form.js"></script>
<script src="./Public/js/coloris.min.js"></script>
<script src="./Public/js/color_logo_form.js"></script>