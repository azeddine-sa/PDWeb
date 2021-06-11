<?php
@session_start();
include("./Commons/connexionBdd.php");

$prod=$bdd->prepare("SELECT * From produits");
//execute la requete
$prod->execute();


$id_user = $_SESSION['id'];

if(isset($_GET['cle'])){
    $cle = $_GET['cle'];
    $_SESSION['panier'][$cle] = 0;
}

if ((isset($_POST['videpanier']))) {
    foreach ($_SESSION['panier'] as $key => $value)
        $_SESSION['panier'][$key] = 0;

    $_SESSION['nb_tot_art'] = 0;
    $_SESSION['total_achats'] = 0;
}

if ((isset($_POST['validerpanier']))) {
    //ajout de la facture dans la bd
    $totalachat = $_SESSION['tot_achat'];
    $fac = $bdd->prepare('INSERT INTO facture(user_id,prixtotal,dateachat) values (?,?,now()) ');
    $fac->execute(array($id_user, $totalachat));

    //recuperer l'id de la facture ajouté au dessus
    $recidfac=$bdd->prepare('Select id_facture from facture ORDER BY dateachat DESC LIMIT 1');
    $recidfac->execute();
    $rid=$recidfac->fetchAll();
    $idfac = 0;
    foreach ($rid as $valeur)
        $idfac=$valeur['id_facture'];

    //ajout des lignes factures dans la bd
    while ($p=$prod->fetch()){
        foreach ($_SESSION['panier'] as $key=>$value){
            if ($value!=0){
                if($p['id_produit']==$key){
                    $linefact = $bdd->prepare('INSERT INTO lignefacture(facture_id,produit_id,quantite,prixligne) values (?,?,?,?) ');
                    $prixligne = $value*$p['prixunitaire'];
                    $linefact->execute(array($idfac,$p['id_produit'],$value,$prixligne));
                }
            }
        }
    }



}
header("location:panier.php");
?>