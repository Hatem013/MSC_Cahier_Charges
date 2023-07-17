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
    <label>Sélectionnez un type de header :</label><br>
    <?php
    $imageFolder = "./Public/asset/image/";

    for ($i = 1; $i <= 20; $i++) {
      $imageName = "header" . $i . ".png";
      $imagePath = $imageFolder . $imageName;
      echo '<label for="header' . $i . '">';
      echo '<input type="radio" id="header' . $i . '" name="header" value="' . $imagePath . '">';
      echo '<img class="headerTaille" src="' . $imagePath . '" alt="Header ' . $i . '">';
      echo '</label>';
    }
    ?>
    <div class="row p-2">
      <button type="submit" class="btn my-3">Formulaire suivant</button>
    </div>
  </form>
</div>
<script src="./Public/js/progress.js"></script>