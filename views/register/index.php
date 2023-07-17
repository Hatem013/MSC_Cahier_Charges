<?php

include_once ROOT.'/views/home/header.php';
include_once ROOT.'/views/home/footer.php';


?>
    <div class="container formulaire">
<form class="mx-auto text-center" method="post">
    <div class="mb-5 form-group">
        <label for="nom">Nom</label><br>
        <input type="text" class="form-control" name="nom" id="nom">
    </div>
    <div class="mb-5 form-group">
    <label for="prenom">Prenom</label><br>
    <input type="text" class="form-control" name="prenom" id="prenom">
    </div>
    <div class="mb-5 form-group">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" class="form-control" name="pseudo" id="pseudo">
    </div>
    <div class="mb-5 form-group">
    <label for="email">Email</label><br>
    <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="mb-5 form-group">
    <label for="password">Mot de passe</label><br>
    <input type="password" class="form-control" name="password" id="password">
    </div>
    <div class="row p-2">
  <button type="submit" class="btn my-3">Créer un compte</button>
  </div>
</form>
</div>