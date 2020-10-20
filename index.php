<?php

require_once './App/Models/Brand.class.php';
require_once './App/Models/Config.class.php';
require_once './App/Models/CpuComponent.class.php';
require_once './App/Models/GpuComponent.class.php';
require_once './App/Models/HddComponent.class.php';
require_once './App/Models/RamComponent.class.php';
require_once './App/Models/OsComponent.class.php';

// Initialise une interface avec la base de données
$databaseHandler = new PDO('mysql:host=localhost;dbname=php-config', 'root', 'root');

// Récupère l'ensemble des composants afin de les proposer dans le formulaire
$cpus = fetchAllCpuComponents();
$gpus = fetchAllGpuComponents();
$hdds = fetchAllHddComponents();
$os = fetchAllOsComponents();
$rams = fetchAllRamComponents();

// Si le formulaire vient d'être validé
if (
    isset($_GET['cpu'])
    && isset($_GET['gpu'])
    && isset($_GET['hdd'])
    && isset($_GET['os'])
    && isset($_GET['ram'])
) {
    // Crée une nouvelle configuration à partir de la sélection de l'utilisateur
    $config = new Config(
        null,
        '',
        $_GET['cpu'],
        $_GET['gpu'],
        $_GET['hdd'],
        $_GET['ram'],
        $_GET['os']
    );

    // Calcule le prix total de la configuration
    $totalPrice = $config->getTotalPrice();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Composez votre PC gaming sur mesure</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <img src="images/Headerbild-pc-gamer-main.jpg" class="img-fluid mb-4" alt="PC gamer" />
        <h1>Composez votre PC gaming sur mesure</h1>
        
        <?php if (isset($totalPrice)): ?>
        <div class="alert alert-info" role="alert">
            Votre configuration s'élève à <?= $totalPrice ?> &euro;
        </div>
        <?php endif; ?>

        <form>
            <h2 class="mt-4 mb-2">Composants</h2>
            <div class="form-group">
                <label for="cpu">Processeur</label>
                <select name="cpu" class="form-control">
                    <?php foreach ($cpus as $cpu): ?>
                    <option value="<?= $cpu->getId() ?>"><?= $cpu->getName() ?> - <?= $cpu->getPrice() ?> &euro;</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ram">Mémoire vive</label>
                <select name="ram" class="form-control">
                    <?php foreach ($rams as $ram): ?>
                    <option value="<?= $ram->getId() ?>"><?= $ram->getName() ?> - <?= $ram->getPrice() ?> &euro;</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="gpu">Carte graphique</label>
                <select name="gpu" class="form-control">
                    <?php foreach ($gpus as $gpu): ?>
                    <option value="<?= $gpu->getId() ?>"><?= $gpu->getName() ?> - <?= $gpu->getPrice() ?> &euro;</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="hdd">Stockage</label>
                <select name="hdd" class="form-control">
                    <?php foreach ($hdds as $hdd): ?>
                    <option value="<?= $hdd->getId() ?>"><?= $hdd->getName() ?> - <?= $hdd->getPrice() ?> &euro;</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="os">Système d'exploitation</label>
                <select name="os" class="form-control">
                    <option value="0">Pas de système d'exploitation</option>
                    <?php foreach ($os as $osItem): ?>
                    <option value="<?= $osItem->getId() ?>"><?= $osItem->getName() ?> - <?= $osItem->getPrice() ?> &euro;</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Calculer</input>
        </form>
    </div>
</body>
</html>