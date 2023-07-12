<?php

include_once ROOT . 'views/home/header.php';
include_once ROOT . 'views/home/footer.php';

session_start();
require_once ROOT . 'App/Model.php';
?>
<div class="container formulaire">
<form method="post" action="">
<label>Sélectionnez une image :</label><br>
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
  
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div>
