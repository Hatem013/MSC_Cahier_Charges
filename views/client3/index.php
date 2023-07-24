<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';

session_start();
$_SESSION['currentStep'] = 3;
require_once ROOT . 'App/Model.php';
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
    <li class="progressed"> ------✔️----- </li>
    <li <?php if ($_SESSION['currentStep'] == 2) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client2" ?>><img src="./Public/asset/svg/two.svg" class="logo_previous_progress"></a></li>
    <li class="progressed"> ------✔️----- </li>
    <li <?php if ($_SESSION['currentStep'] == 3) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client3" ?>><img src="./Public/asset/svg/three.svg" class="logo_previous_progress"></a></li>
    <li class="progressed"> ------✔️----- </li>
    <li <?php if ($_SESSION['currentStep'] == 4) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client4" ?>><img src="./Public/asset/svg/four.svg" class="logo_current_progress"></a></li>
    <li class="in_progress"> ------🚧----- </li>
    <li <?php if ($_SESSION['currentStep'] == 5) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client5" ?>><img src="./Public/asset/svg/five.svg" class="logo_progress"></a></li>
    <li class="in_progress"> ----------- </li>
    <li <?php if ($_SESSION['currentStep'] == 6) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client6" ?>><img src="./Public/asset/svg/six.svg" class="logo_progress"></a></li>
  </ul>


  <form method="post" action="">

    <!-- Header -->
    <div class="row">
      <div class="col-3">
        <p>
          <button class="btn" id="header_desktop_btn" type="button" onclick="desktopMenuDisplay()"data-bs-toggle="collapse" data-bs-target="#collapseHeader" aria-expanded="false" aria-controls="collapseHeader">
            Selectionnez votre header sur ordinateur
          </button>
        </p>
      </div>
      <div class="col-6 d-none" id="header_preview">
        <img  id="header_preview_img" src="">
      </div>
      <div class="col-6 d-none" id="header_selection_display"style="min-height: 120px;">
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
              echo '<input type="radio" onchange="desktopPreview()" class="form-check-input" id="header' . $i . '" name="header" value="' . $image1Path . '">';
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
      <div class="col-3">
        <p>
          <button class="btn btn-primary" id="header_mobile_btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHeaderMobile" aria-expanded="false" aria-controls="collapseHeaderMobile">
            Selectionnez l'affichage sur mobile et tablette
          </button>
        </p>
      </div>
      <div class="col-6" style="min-height: 120px;">
        <div class="collapse collapse-horizontal" id="collapseHeaderMobile">
          <div class="card card-body" id="header_mobile_card">

            <?php
            $imageFolder = "./Public/asset/image/";

            for ($i = 7; $i <= 9; $i++) {
              $image1Name = "framehm" . $i . ".svg";
              $image1Path = $imageFolder . $image1Name;

              // Affichage des 3 dernières images dans une div séparée
              if ($i > 3) {
                echo '<div class="row">';
              } else {
                echo '<div class="row">';
              }
              echo '<div class="row">';

              echo '<label class="col-3" for="header_mobile' . $i . '">';
              echo '<input type="radio" id="header_mobile' . $i . '" name="header_mobile" value="' . $image1Path . '">';
              echo '<img class="headerMobileTaille img-fluid" src="' . $image1Path . '" alt="Header_mobile ' . $i . '">';
              echo '</label>';
              echo '</div>';
              echo '</div>';
            }
            ?>

          </div>
        </div>
      </div>
    </div>

    <div class="row p-2">
      <button type="submit" class="btn my-3">Formulaire suivant</button>
    </div>



</div>
</div>

</form>
</div>

<script src="./Public/js/header_form.js"></script>