<?php

require_once './App/Views/StandardView.class.php';

final class ConfigController
{
    public function listAll()
    {
        // Crée une nouvelle vue destinée à afficher la liste des configs existantes
        // auquel on passe la liste de toutes les configurations existantes en BDD
        return new StandardView([
            'config-list'
        ], [
            'configs' => fetchAllConfigs()
        ]);
    }

    public function new()
    {
        // Crée une nouvelle vue destinée à afficher le formulaire de création de configs
        return new StandardView([
            'config-form'
        ], [
            'cpus' => fetchAllCpuComponents(),
            'gpus' => fetchAllGpuComponents(),
            'hdds' => fetchAllHddComponents(),
            'os' => fetchAllOsComponents(),
            'rams' => fetchAllRamComponents(),
        ]);
    }
}
