<?php
try {
        $db = new PDO('mysql:host=localhost;dbname=concierge', 'root', '');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $db;
        }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    };

   
?>