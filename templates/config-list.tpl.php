<!-- config-list.tpl.php -->
<div class="container">

    <?php if (isset($_POST['delete'])): ?>
        <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            Configuration supprimée avec succès!
        </div>
        <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Erreur lors de la suppression de la configuration!
        </div>
        <?php endif; ?>
    <?php endif; ?>

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
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
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
                <td>
                    <form action="/">
                        <input type="hidden" name="id" value="<?= $config->getId() ?>" />
                        <button type="submit" class="btn btn-outline-warning">Modifier</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="delete" value="<?= $config->getId() ?>" />
                        <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
