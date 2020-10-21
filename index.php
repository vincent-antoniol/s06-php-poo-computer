<?php

// Charge les dépendances
require_once './App/Views/HomeView.class.php';
require_once './App/Views/StandardView.class.php';
require_once './App/Models/Config.class.php';
require_once './App/Models/CpuComponent.class.php';
require_once './App/Models/GpuComponent.class.php';
require_once './App/Models/HddComponent.class.php';
require_once './App/Models/RamComponent.class.php';
require_once './App/Models/OsComponent.class.php';
require_once './App/Controllers/MainController.class.php';
require_once './App/Controllers/ErrorController.class.php';
require_once './App/Controllers/ConfigController.class.php';

// Initialise une interface avec la base de données
$databaseHandler = new PDO('mysql:host=localhost;dbname=php-config', 'root', 'root');
$databaseHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$databaseHandler->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// Si le serveur n'a pas enregistré d'URI demandée, c'est donc que c'est la page d'accueil qui a été demandée
if (isset($_REQUEST['_url'])) {
    // Retient l'URI demandée
    $requestedUrl = $_REQUEST['_url'];
} else {
    // Retient le chemin de la page d'accueil
    $requestedUrl = '/';
}

// En fonction de l'URI demandée par l'utilisateur
switch ($requestedUrl) {
    case '/':
        $controller = new MainController;
        $view = $controller->home();
        break;

    case '/config':
        $controller = new ConfigController;
        $view = $controller->listAll();
        break;

    case '/config/edit':
        $controller = new ConfigController;
        $view = $controller->new();
        break;
    
    default:
        $controller = new ErrorController;
        $view = $controller->pageNotFound();
}

// Affiche la vue
$view->render();
