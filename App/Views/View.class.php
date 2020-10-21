<?php

abstract class View
{
    protected $templates;
    protected $variables;
   
    /**
     * Create a new View object
     * 
     * @param array $templates List of templates to be displayed inside the view
     * @param array $variables (Optional) Associative array matching each required variable name with its value
     */
    public function __construct(array $templates, array $variables = [])
    {
        $this->templates = $templates;
        $this->variables = $variables;
    }

    abstract public function render();
}
