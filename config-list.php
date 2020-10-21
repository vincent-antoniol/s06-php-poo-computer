<?php

// Charge les dépendances
require_once './App/Views/StandardView.class.php';
require_once './App/Models/Config.class.php';

// Initialise une interface avec la base de données
$databaseHandler = new PDO('mysql:host=localhost;dbname=php-config', 'root', 'root');
$databaseHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$databaseHandler->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// Crée une nouvelle vue destinée à afficher la liste des configs existantes
// auquel on passe la liste de toutes les configurations existantes en BDD
$view = new StandardView([
    'config-list'
], [
    'configs' => fetchAllConfigs()
]);

// Affiche la vue
$view->render();
