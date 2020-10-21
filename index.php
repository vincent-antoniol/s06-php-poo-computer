<?php

// Charge les dépendances
require_once './App/Views/HomeView.class.php';

// Crée une nouvelle vue destinée à afficher la page d'accueil
$view = new HomeView([
    'home',
]);

// Affiche la vue
$view->render();
