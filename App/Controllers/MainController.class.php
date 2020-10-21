<?php

require_once './App/Views/HomeView.class.php';

final class MainController
{
    public function home()
    {
        // Crée une nouvelle vue destinée à afficher la page d'accueil
        return new HomeView([
            'home',
        ]);
    }
}
