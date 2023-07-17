<?php

include_once ROOT.'/views/home/header.php';
include_once ROOT.'/views/home/footer.php';


?>
<div class="container formulaire mt-5">
<form action="" method="post">
    <div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo">
    </div>
    <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    </div>
    <div class="row p-2">
  <button type="submit" class="btn my-3">Se connecter</button>
  </div>
</form>
</div>