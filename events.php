<?php
// liste des événements
 $json = array();
 // requête qui récupère les événements
 $requete = "SELECT * FROM events ORDER BY id";
 
 // try to connect
include 'bd.php';

 // exécution de la requête
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
 
 // envoi du résultat au success
 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
 
?>