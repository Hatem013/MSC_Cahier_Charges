<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSC Cahier charges</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./Public/css/main.css" rel="stylesheet" type="text/css">
    <link href="./Public/css/coloris.min.css" rel="stylesheet"/>
</head>

<body>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    
    <!-- Logo -->
        <a class="navbar-brand" href="https://www.mon-service-com.fr" target="_blank"><img src="./Public/asset/image/logo_msc.png" class="logo_msc"></a>
    
    <!-- Mobile nav -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <!-- Desktop nav -->
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav">

                <!-- Accueil -->
                <li class="nav-item <?php if ($page == 'home') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="/MSC-1/home">Accueil</a>
                </li>

                <!-- Créer son site -->
                <li class="nav-item <?php if ($page == 'client') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="/MSC-1/client">Créer votre site</a>
                </li>
                
                <!-- Mon compte -->
                <div class="dropdown">

                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mon compte
                    </a>
                    <!-- Dropdown -->
                    <ul class="dropdown-menu">

                        <!-- Dashboard -->
                        <li class="nav-item <?php if ($page == 'dashboard') {
                                                echo 'active';
                                            } ?>">
                            <a class="dropdown-item" href="/MSC-1/dashboard">Tableau de bord</a>
                        </li>

                        <!-- Mes demandes -->
                        <li class="nav-item <?php if ($page == 'site') {
                                                echo 'active';
                                            } ?>">
                            <a class="dropdown-item" href="/MSC-1/site">Mes demandes</a>
                        </li>

                    </ul>
                </div>

                <!-- Menu connexion à voir plus tard
                <li class="nav-item <?php if ($page == 'login') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="/MSC-1/login">Connexion</a>
                </li>
                <li class="nav-item <?php if ($page == 'register') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="/MSC-1/register">Inscription</a>
                </li>                          
-->
            </ul>
        </div>
    </nav>