<?php

//preparation de la requete de recherche dans la base de donnée des produits
$req1=$bdd->prepare("SELECT * FROM produits WHERE categorie_id=1");
//execution de la requete
$req1->execute();

$req2=$bdd->prepare("SELECT * FROM produits WHERE categorie_id=2");
$req2->execute();


$req3=$bdd->prepare("SELECT * FROM produits WHERE categorie_id=3");
$req3->execute();

$req = array("Informatiques"=>$req1,
    "Livres"=>$req2,
    "Hifi"=>$req3);
?>
