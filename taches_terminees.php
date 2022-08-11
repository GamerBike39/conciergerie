<?php
session_start();
if(isset($_SESSION['login_user'])){
echo "Bienvenue Monsieur ".$_SESSION['login_user']." <a href='./index.php'>Se déconnecter</a>";
}
else{
    header('Location: ./index.php');
}
include_once 'includes/header.php';
include_once 'includes/co.php';


// on traite le formulaire
if(!empty($_POST)){
    // post n'est pas vide, on vérifie que toutes les données sont présentes
    if (
        isset($_POST["tache_faite"], $_POST["etage"], $_POST["numero_appartement"], $_POST["date"])
       && !empty($_POST["tache"]) && !empty($_POST["etage"]) && !empty($_POST["numero_appartement"]) && !empty($_POST["date"])
    ){
$tache_faite = $_POST["tache_faite"];
$etage = $_POST["etage"];
$num_appartement = $_POST["numero_appartement"];
$date = $_POST["date"];


// on écrit la requete
$sql = "INSERT INTO `tache_faite` (`id_tache_faite`, `tache_faite`, `date`, `etage`, `numero_appartement`) VALUES (NULL, 'changement du syphon', '2022-08-24', '3', '2')";
$query = $db->prepare($sql);
$query->bindValue(":tache", $tache_faite, PDO::PARAM_STR);
$query->bindValue(":etage", $etage, PDO::PARAM_INT);
$query->bindValue(":numero_appartement", $num_appartement, PDO::PARAM_INT);
$query->bindValue(":dateIntervention", $date, PDO::PARAM_STR);
if(!$query->execute()){
    die ("Erreur lors de l'insertion");
}
$id = $db->lastInsertId();
die ("taches ajoutée avec succès sous le numéro $id");
    }
    else{
        die("le formulaire est incomplet");
    }
};

$sql = "SELECT * FROM `tache_faite`";
$query = $db->query($sql);
$tache_faite = $query->fetchAll();

?>
<div class="container mt-5">
    <div class="row">
        <form action="includes/co.php" method="post" class="col-4">
            <h1>Taches faites</h1>
            <div class="form-group">
                <label for="etage">etage</label>
                <input type="number" class="form-control" id="etage" name="etage" placeholder="etage" required min="-1">
                <label for="numero_appartement">numéro appartement</label>
                <input type="number" class="form-control" id="numero_appartement" name="numero_appartement"
                    placeholder="numéro appartement" min="0" required>
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <button type="submit" class="btn btn-primary">Verifier</button>
        </form>
    </div>
</div>
<?php foreach ($tache_faite as $tacheF) : ?>
<article>
    <div class="metadata">
        <p> Taches effectuées : <?= strip_tags($tacheF['tache_faite']) ?></p>
        <p> étage numéro : <?= strip_tags($tacheF['etage']) ?></p>
        <p> Appartement numéro <?= strip_tags($tacheF['numero_appartement']) ?> </p>
        <p> Le <?= strip_tags($tacheF['date']) ?></p>
    </div>
    <!-- strip_tags prévient de l'intégration de l'html, en gros c'est un textContent -->
</article>
<?php endforeach; ?>

<?php
include_once 'includes/footer.php';
?>