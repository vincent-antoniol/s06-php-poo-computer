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
        <form>
            <h2 class="mt-4 mb-2">Composants</h2>
            <div class="form-group">
                <label for="cpu">Processeur</label>
                <select name="cpu" class="form-control">
                    <option value="1">Acu j3 Dual-Core (9ème génération)</option>
                    <option value="2">Acu j5 Quad-Core (9ème génération)</option>
                    <option value="3">Acu j7 Octo-Core (9ème génération)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ram">Mémoire vive</label>
                <select name="ram" class="form-control">
                    <option value="1">2 x 4 Go π-Rate DDR4</option>
                    <option value="2">1 x 8 Go π-Rate DDR4</option>
                    <option value="3">2 x 8 Go π-Rate DDR4</option>
                    <option value="4">1 x 16 Go π-Rate DDR4</option>
                    <option value="5">2 x 16 Go π-Rate DDR4</option>
                    <option value="6">1 x 32 Go π-Rate DDR4</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gpu">Carte graphique</label>
                <select name="gpu" class="form-control">
                    <option value="1">MSCOPIA VeStrength 1050 GTX</option>
                    <option value="2">MSCOPIA VeStrength 1650 GTX</option>
                    <option value="3">MSCOPIA VeStrength 2050 GTX</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hdd">Stockage</label>
                <select name="hdd" class="form-control">
                    <option value="1">π-Rate 500 Go HDD</option>
                    <option value="2">π-Rate 1 To HDD</option>
                    <option value="3">π-Rate 2 To HDD</option>
                    <option value="4">Taeyong EVO 250 Go SSD</option>
                    <option value="5">Taeyong EVO 500 Go SSD</option>
                    <option value="6">Taeyong EVO 1 To SSD</option>
                </select>
            </div>
            <div class="form-group">
                <label for="os">Système d'exploitation</label>
                <select name="os" class="form-control">
                    <option value="0">Pas de système d'exploitation</option>
                    <option value="1">Nanosoft Shutters® 10 - édition familiale</option>
                    <option value="2">Nanosoft Shutters® 10 - édition professionnelle</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Calculer</input>
        </form>
    </div>
</body>
</html>