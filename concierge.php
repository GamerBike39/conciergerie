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
        isset($_POST["tache"],$_POST["nom_resident"], $_POST["etage"], $_POST["numero_appartement"], $_POST["date"])
       && !empty($_POST["tache"]) && !empty($_POST["nom_resident"]) && !empty($_POST["etage"]) && !empty($_POST["numero_appartement"]) && !empty($_POST["date"])
    ){
$tache = $_POST["tache"];
$nom_resident = $_POST["nom_resident"];
$etage = $_POST["etage"];
$num_appartement = $_POST["numero_appartement"];
$date = $_POST["date"];


// on écrit la requete
$sql = "INSERT INTO `tache_a_faire` (`tache`,`nom_resident`, `etage`, `numero_appartement`, `date`) VALUES (:tache, :nom_resident, :etage, :numero_appartement, :dateIntervention)";
$query = $db->prepare($sql);
$query->bindValue(":tache", $tache, PDO::PARAM_STR);
$query->bindValue(":nom_resident", $nom_resident, PDO::PARAM_STR);
$query->bindValue(":etage", $etage, PDO::PARAM_INT);
$query->bindValue(":numero_appartement", $num_appartement, PDO::PARAM_INT);
$query->bindValue(":dateIntervention", $date, PDO::PARAM_STR);
if(!$query->execute()){
    die ("Erreur lors de l'insertion");
}
$id = $db->lastInsertId();
// Retourne l'identifiant de la dernière ligne insérée ou la valeur d'une séquence 
echo "taches ajoutée avec succès sous le numéro $id";
    }
    else{
        die("le formulaire est incomplet");
    }
};

$sql = "SELECT * FROM `tache_a_faire`";
$query = $db->query($sql);
$tache_a_faire = $query->fetchAll();

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 row">
            <!-- <form action="concierge.php" method="post" class="col-4">
            <h1>Résident</h1>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
                <label for="etage">etage</label>
                <input type="number" class="form-control" id="etage" name="etage" placeholder="etage" required min="-1">
                <label for="num_appartement">numéro appartement</label>
                <input type="number" class="form-control" id="num_appartement" name="num_appartement"
                    placeholder="numéro appartement" min="0" required>
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <button type="submit" class="btn btn-primary">Verifier</button>
            </form> -->
            <div>
                <form method="post" class="col-4">
                    <h1>Taches à faire</h1>
                    <div class="form-group">
                        <label for="tache">tache</label>
                        <input type="textarea" class="form-control" id="tache" name="tache" placeholder="tache"
                            required>
                        <label for="nom_resident">nom</label>
                        <input type="text" class="form-control" id="nom_resident" name="nom_resident"
                            placeholder="nom_resident" required>
                        <label for="etage">étage</label>
                        <input type="number" class="form-control" id="etage" name="etage" placeholder="etage" required
                            min="-1" max="10">
                        <label for="numero_appartement">numéro appartement</label>
                        <input type="number" class="form-control" id="numero_appartement" name="numero_appartement"
                            placeholder="numéro appartement" min="1" max="5" required>
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
                <div>
                    <!-- creer un tableau avec les valeurs du formulaire -->
                    <table>
                        <thead>
                            <tr>
                                <th>Tache à effectuer</th>
                                <th>Résident</th>
                                <th>étage</th>
                                <th>appartement</th>
                                <th>Date</th>
                                <th>Supprimer</th>
                                <th>Terminée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tache_a_faire as $tache) : ?>
                            <tr>
                                <td><?= strip_tags($tache['tache']) ?></td>
                                <td><?= strip_tags($tache['nom_resident']) ?></td>
                                <td><?= strip_tags($tache['etage']) ?></td>
                                <td><?= strip_tags($tache['numero_appartement']) ?></td>
                                <td><?= strip_tags($tache['date']) ?></td>
                                <td>
                                    <form action="includes/delete.php" method="get">
                                        <input type="hidden" name="id_tache" value="<?= $tache['id_tache'] ?>">
                                        <input type="submit" value="Supprimer">
                                    </form>
                                </td>
                                <td>
                                    <form action="includes/finish.php" method="get">
                                        <input type="hidden" name="id_tache" value="<?= $tache['id_tache'] ?>">
                                        <input type="submit" value="terminée">
                                    </form>
                                <td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <form action="concierge.php" method="post" class="col-4">
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
            </form> -->
        </div>
    </div>


    <?php
include_once 'includes/footer.php';
?>