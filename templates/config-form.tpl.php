<!-- config-form.tpl.php -->
<div class="container">
    <img src="images/Headerbild-pc-gamer-main.jpg" class="img-fluid mb-4" alt="PC gamer" />
    <h1>Composez votre PC gaming sur mesure</h1>
    
    <?php if (isset($totalPrice)): ?>
    <div class="alert alert-info" role="alert">
        Votre configuration s'élève à <?= $totalPrice ?> &euro;

        <?php if ($created): ?>
        <div>Votre configuration a été enregistrée avec succès!</div>
        <?php endif; ?>
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
        <div class="form-group">
            <label for="name">Donnez un nom à votre configuration (facultatif)</label>
            <input type="text" name="name" placeholder="Laissez vide si vous ne souhaitez pas enregistrer la configuration" class="form-control" />
        </div>

        <!-- Si l'utilisateur a atterri sur ce formulaire après avoir cliqué
        sur le bouton "modifier" d'une configuration -->
        <?php if (isset($_GET['id'])): ?>
            <!-- Rajoute une propriété "id" dans les paramètres qui vont être
            envoyés avec le formulaire -->
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
        <?php endif;?>

        <button type="submit" class="btn btn-primary">Calculer</input>
    </form>
</div>
