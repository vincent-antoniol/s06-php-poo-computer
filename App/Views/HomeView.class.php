<?php

require_once './App/Views/View.class.php';

class HomeView extends View
{
    /**
     * Render the view as HTML page
     */
    public function render()
    {
        // Crée une variable pour chaque couple de nom de variable/valeur reçu en entrée
        foreach ($this->variables as $varName => $value) {
            $$varName = $value;
        }

        include './templates/head.tpl.php';
        // Charge tous les templates dans l'ordre
        foreach ($this->templates as $template) {
            include './templates/' . $template . '.tpl.php';
        }
        include './templates/foot.tpl.php';
    }
}
