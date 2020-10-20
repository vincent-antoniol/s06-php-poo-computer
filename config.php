<?php

require_once './App/Models/Config.class.php';

// Initialise une interface avec la base de données
$databaseHandler = new PDO('mysql:host=localhost;dbname=php-config', 'root', 'root');

$configs = fetchAllConfigs();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Processeur</th>
                    <th scope="col">Carte graphique</th>
                    <th scope="col">Stockage</th>
                    <th scope="col">Mémoire vive</th>
                    <th scope="col">Système d'exploitation</th>
                    <th scope="col">Prix total</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($configs as $config): ?>
                <tr>
                    <th scope="row"><?= $config->getId() ?></th>
                    <td><?= $config->getName() ?></td>
                    <td><?= $config->getCpu()->getName() ?></td>
                    <td><?= $config->getGpu()->getName() ?></td>
                    <td><?= $config->getHdd()->getName() ?></td>
                    <td><?= $config->getRam()->getName() ?></td>
                    <td>
                        <?php
                        
                        $os = $config->getOs();
                        if (is_null($os)) {
                            echo '-';
                        } else {
                            echo $os->getName();
                        }
                        
                        ?>
                    </td>
                    <td><strong><?= $config->getTotalPrice() ?> &euro;</strong></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</body>

</html>