<?php
session_start();
if(isset($_SESSION['login_user'])){
echo "Bienvenue Monsieur ".$_SESSION['login_user']." <a href='./index.php'>Se déconnecter</a>";
}
else{
    header('Location: ./index.php');
}
include_once 'includes/header.php';
include_once 'includes/navbar.php';
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
$sql = "INSERT INTO `tache_faite` (`tache_faite`, `date`, `etage`, `numero_appartement`) VALUES (NULL, :tache, :dateIntervention, :etage, :numero_appartement)";
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
                <label for="nom_resident">nom_resident</label>
                <input type="text" class="form-control" id="nom_resident" name="nom_resident">
                <label for="etage">etage</label>
                <input type="number" class="form-control" id="etage" name="etage" placeholder="etage" min="-1">
                <label for="numero_appartement">numéro appartement</label>
                <input type="number" class="form-control" id="numero_appartement" name="numero_appartement"
                    placeholder="numéro appartement" min="0">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <button type="submit" class="btn btn-primary">Verifier</button>
        </form>


        <div class="article">
            <table>
                <thead>
                    <tr>
                        <th>Tache à effectuer</th>
                        <th>Résident</th>
                        <th>étage</th>
                        <th>appartement</th>
                        <th>Date</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tache_faite as $tacheF) : ?>
                    <tr>
                        <td><?= strip_tags($tacheF['tache_faite']) ?></td>
                        <td><?= strip_tags($tacheF['nom_resident']) ?></td>
                        <td><?= strip_tags($tacheF['etage']) ?></td>
                        <td><?= strip_tags($tacheF['numero_appartement']) ?></td>
                        <td><?= strip_tags($tacheF['date']) ?></td>
                        <td>
                            <form action="includes/deleteF.php" method="get">
                                <input type="hidden" name="id_tache" value="<?= $tacheF['id_tache'] ?>">
                                <input type="submit" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once 'includes/footer.php';
?>

<!-- recherche dans la base de donnée tache_faite depuis le formulaire -->
<!-- SELECT * FROM `tache_faite` WHERE AND `etage` LIKE '%<?= $etage ?>%'
SELECT * FROM `tache_faite` WHERE AND `etage` LIKE '%<?= $etage ?>%' AND `numero_appartement` LIKE
'%<?= $numero_appartement ?>%'
SELECT * FROM `tache_faite` WHERE AND `etage` LIKE '%<?= $etage ?>%' AND `numero_appartement` LIKE
'%<?= $numero_appartement ?>%' AND `date` LIKE '%<?= $date ?>%'
SELECT * FROM `tache_faite` WHERE AND `etage` LIKE '%<?= $etage ?>%' AND `numero_appartement` LIKE
'%<?= $numero_appartement ?>%' AND `date` LIKE '%<?= $date ?>%' AND `nom_resident` LIKE '%<?= $nom_resident ?>%'
SELECT * FROM `tache_faite` WHERE AND `etage` LIKE '%<?= $etage ?>%' AND `numero_appartement` LIKE
'%<?= $numero_appartement ?>%' AND `date` LIKE '%<?= $date ?>%' AND `nom_resident` LIKE '%<?= $nom_resident ?>%' AND
`id_tache` LIKE '%<?= $id_tache ?>%'
SELECT * FROM `tache_faite` WHERE AND `etage` LIKE '%<?= $etage ?>%' AND `numero_appartement` LIKE
'%<?= $numero_appartement ?>%' AND `date` LIKE '%<?= $date ?>%' AND `nom_resident` LIKE '%<?= $nom_resident ?>%' AND
`id_tache` LIKE '%<?= $id_tache ?>%' AND `id_resident` LIKE '%<?= $id_resident ?>%'
SELECT * FROM `tache_faite` WHERE AND `etage` LIKE '%<?= $etage ?>%' AND `numero_appartement` LIKE
'%<?= $numero_appartement ?>%' AND `date` LIKE '%<?= $date ?>%' AND `nom_resident` LIKE '%<?= $nom_resident ?>%' AND
`id_tache` LIKE '%<?= $id_tache ?>%' AND `id_resident` LIKE '%<?= $id_resident ?>%' AND `id_intervention` LIKE
'%<?= $id_intervention ?>%' -->