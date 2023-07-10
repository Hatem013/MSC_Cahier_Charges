<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSC Cahier charges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/mvc/home">Site cahier de Charge</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item <?php if ($page == 'home') {echo 'active';}?>">
                    <a class="nav-link" href="/MSC-1/home">Accueil</a>
                </li>
                <li class="nav-item <?php if ($page == 'login') {echo 'active';}?>">
                    <a class="nav-link" href="/MSC-1/login">Connexion</a>
                </li>
                <li class="nav-item <?php if ($page == 'register') {echo 'active';}?>">
                    <a class="nav-link" href="/MSC-1/register">Inscription</a>
                </li>
                <li class="nav-item <?php if ($page == 'dashboard') {echo 'active';}?>">
                    <a class="nav-link" href="/MSC-1/dashboard">Tableau de bord</a>
                </li>
                <li class="nav-item <?php if($page == 'client'){ echo 'active';}?>">
                    <a class="nav-link" href="/MSC-1/client">Clients</a>
                </li>
                <li class="nav-item <?php if($page == 'site') {echo 'active';}?>">
                    <a class="nav-link" href="/MSC-1/site">Sites</a>
                </li>
            </ul>
        </div>
    </nav>