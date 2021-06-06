<?php

//preparation de la requete de recherche dans la base de donnée des produits
$req1=$bdd->prepare("SELECT * FROM blog ORDER BY datecreation DESC LIMIT 0,4");

//execute la requete avec le login saisi par l'utilisateur
$req1->execute();

?>