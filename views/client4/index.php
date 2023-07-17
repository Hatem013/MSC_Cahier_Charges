<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';

session_start();
$_SESSION['currentStep'] = 4;
require_once ROOT . 'App/Model.php';
?>
<div class="container formulaire">
  <div class="container text-center mt-4 mb-5">
    <h1>Suite du formulaire</h1>
    <h2>Entrez les différentes informations pour un site plus personnel</h2>
  </div>
  <ul class="progressbar">
    <li <?php if ($_SESSION['currentStep'] == '') {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client" ?>>Étape 1</a></li>
    <li <?php if ($_SESSION['currentStep'] == 2) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client2" ?>>Étape 2</a></li>
    <li <?php if ($_SESSION['currentStep'] == 3) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client3" ?>>Étape 3</a></li>
    <li <?php if ($_SESSION['currentStep'] == 4) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client4" ?>>Étape 4</a></li>
    <li <?php if ($_SESSION['currentStep'] == 5) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client5" ?>>Étape 5</a></li>
    <li <?php if ($_SESSION['currentStep'] == 6) {
          echo 'class="active"';
        } ?>><a href=<?php ROOT . "views/client6" ?>>Étape 6</a></li>
  </ul>
  <div class="progress"></div>



























































<script src="./Public/js/progress.js"></script>