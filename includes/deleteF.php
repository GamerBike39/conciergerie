<?php
session_start();

// est-ce que l'id existe et n'est pas vide ? 
if(isset($_GET['id_tache']) && !empty($_GET['id_tache'])){
    $id_tache = $_GET['id_tache'];
    require_once("co.php");
    // on écrit la requete
    $sql = "DELETE FROM `tache_faite` WHERE `id_tache` = :id_tache"; 
    $query = $db->prepare($sql);
    $query->bindValue(":id_tache", $id_tache, PDO::PARAM_INT);
    if(!$query->execute()){
        var_dump($query);
        die ("Erreur lors de la suppression1");
    }
    else{
        die ("tache supprimée avec succès");
    }
}
else{
    die ("Erreur lors de la suppression2");
}


?>