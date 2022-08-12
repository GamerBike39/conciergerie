<?php

session_start();

// est-ce que l'id existe et n'est pas vide ? 
if(isset($_GET['id_tache']) && !empty($_GET['id_tache'])){
    $id_tache = $_GET['id_tache'];
    require_once("co.php");
    $sql = "INSERT INTO `tache_faite` (`id_tache`, `tache_faite`, `nom_resident`, `etage`, `numero_appartement`, `date`) SELECT `id_tache`, `tache`, `nom_resident`, `etage`, `numero_appartement`, `date` FROM `tache_a_faire` WHERE `id_tache` = :id_tache; DELETE FROM `tache_a_faire` WHERE `id_tache` = :id_tache";
    $sql = 
    $query = $db->prepare($sql);
    $query->bindValue(":id_tache", $id_tache, PDO::PARAM_INT);
    if(!$query->execute()){
        var_dump($query);
        echo "coucou ";
        die ("Erreur lors du changement1");
    }
    else{
        die ("changement réalisé avec succès");
    }
}
else{
    die ("Erreur lors du changement2");
}

?>