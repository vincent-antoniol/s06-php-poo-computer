<?php

final class ErrorController
{
    public function pageNotFound()
    {
        // Crée une nouvelle vue destinée à afficher la page 404 (page non trouvée)
        return new StandardView([
            'not-found'
        ]);
    }
}
