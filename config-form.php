<?php

// Charge les dépendances
require_once './App/Views/StandardView.class.php';
require_once './App/Models/CpuComponent.class.php';
require_once './App/Models/GpuComponent.class.php';
require_once './App/Models/HddComponent.class.php';
require_once './App/Models/RamComponent.class.php';
require_once './App/Models/OsComponent.class.php';

// Initialise une interface avec la base de données
$databaseHandler = new PDO('mysql:host=localhost;dbname=php-config', 'root', 'root');
$databaseHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$databaseHandler->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// Crée une nouvelle vue destinée à afficher le formulaire de création de configs
$view = new StandardView([
    'config-form'
], [
    'cpus' => fetchAllCpuComponents(),
    'gpus' => fetchAllGpuComponents(),
    'hdds' => fetchAllHddComponents(),
    'os' => fetchAllOsComponents(),
    'rams' => fetchAllRamComponents(),
]);

// Affiche la vue
$view->render();
