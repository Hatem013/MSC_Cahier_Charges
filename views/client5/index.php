<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';

session_start();
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

<div class="container formulaire">
    <div class="container text-center mt-4 mb-5">
        <h1>Choisissez votre palette de couleurs</h1>
        <form method="post" action="">
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
    </div>
    <div class="row p-2">
        <button type="submit" class="btn my-3">Formulaire suivant</button>
    </div>
    </form>
</div>