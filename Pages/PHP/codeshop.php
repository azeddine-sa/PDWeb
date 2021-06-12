<?php

//preparation de la requete de recherche dans la base de donnée des produits de catégorie 1 => informatiques
$req1=$bdd->prepare("SELECT * FROM produits WHERE categorie_id=1");
//execution de la requete
$req1->execute();

//preparation de la requete de recherche dans la base de donnée des produits de catégorie 2 => livres
$req2=$bdd->prepare("SELECT * FROM produits WHERE categorie_id=2");
$req2->execute();

//preparation de la requete de recherche dans la base de donnée des produits de catégorie 3 => hifi
$req3=$bdd->prepare("SELECT * FROM produits WHERE categorie_id=3");
$req3->execute();

//tableau reprenenant les 3 tableaux des requetes au dessus
$req = array("Informatiques"=>$req1,
    "Livres"=>$req2,
    "Hifi"=>$req3);
?>
