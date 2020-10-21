<?php

class HomeView
{
    private $templates;

    /**
     * Create a new StandardView object
     * 
     * @param array $templates List of templates to be displayed inside the view
     * @param array $variables (Optional) Associative array matching each required variable name with its value
     */
    public function __construct(array $templates, array $variables = [])
    {
        $this->templates = $templates;
        $this->variables = $variables;
    }

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
