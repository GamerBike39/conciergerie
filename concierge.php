<?php
session_start();
if(isset($_SESSION['login_user'])){
echo "Bienvenue ".$_SESSION['login_user']." <a href='./index.php'>Se déconnecter</a>";
}
else{
    header('Location: ./index.php');
}
include_once 'includes/header.php';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 row">
            <form action="concierge.php" method="post" class="col-4">
                <h1>Résident</h1>
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
                    <label for="etage">etage</label>
                    <input type="number" class="form-control" id="etage" name="etage" placeholder="etage" required
                        min="-1">
                    <label for="num_appartement">numéro appartement</label>
                    <input type="number" class="form-control" id="num_appartement" name="num_appartement"
                        placeholder="numéro appartement" min="0" required>
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <button type="submit" class="btn btn-primary">Verifier</button>
            </form>
            <form action="concierge.php" method="post" class="col-4">
                <h1>Taches à faire</h1>
                <div class="form-group">
                    <label for="type_tache">tache</label>
                    <input type="text" class="form-control" id="type_tache" name="type_tache" placeholder="type_tache"
                        required>
                    <label for="etage">étage</label>
                    <input type="number" class="form-control" id="etage" name="etage" placeholder="etage" required
                        min="-1">
                    <label for="num_appartement">numéro appartement</label>
                    <input type="number" class="form-control" id="num_appartement" name="num_appartement"
                        placeholder="numéro appartement" min="0" required>
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <form action="concierge.php" method="post" class="col-4">
                <h1>Taches faites</h1>
                <div class="form-group">
                    <label for="etage">etage</label>
                    <input type="number" class="form-control" id="etage" name="etage" placeholder="etage" required
                        min="-1">
                    <label for="num_appartement">numéro appartement</label>
                    <input type="number" class="form-control" id="num_appartement" name="num_appartement"
                        placeholder="numéro appartement" min="0" required>
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <button type="submit" class="btn btn-primary">Verifier</button>
            </form>
        </div>
    </div>

    <?php
    include_once 'includes/co.php';
    // lier les formulaires à la base de données

    // ajouter une tache avec execute dans la table tache_a_faire
    if(isset($_POST['type_tache'])){
        $type_tache = $_POST['type_tache'];
        $etage = $_POST['etage'];
        $num_appartement = $_POST['num_appartement'];
        $date = $_POST['date'];
        $sql = "INSERT INTO tache_a_faire ('tache', 'etage', 'num_appartement', 'date') VALUES ('$type_tache', '$etage', '$num_appartement', '$date')";
        $db->exec($sql);
    }


    ?>


    <?php
include_once 'includes/footer.php';
?>