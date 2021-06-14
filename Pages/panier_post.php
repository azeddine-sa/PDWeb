<?php
@session_start();
include("./Commons/connexionBdd.php");

//recupere tout les produits de la bd
$prod=$bdd->prepare("SELECT * From produits");
//execute la requete
$prod->execute();

//initialisation de variable avec la valeur de la variable session id correspondant à l'id utilisateur
$id_user = $_SESSION['id'];

//supprime un article du panier
if(isset($_GET['cle'])){
    $cle = $_GET['cle'];
    $_SESSION['panier'][$cle] = 0;
}

//vide la panier en réinitialisant la variable de session à 0 pour chaque produit
if ((isset($_POST['videpanier']))) {
    foreach ($_SESSION['panier'] as $key => $value)
        $_SESSION['panier'][$key] = 0;

    $_SESSION['nb_tot_art'] = 0;
    $_SESSION['total_achats'] = 0;
}

//Confirmation de l'achat (sans passage par un paiement)
if ((isset($_POST['validerpanier']))) {
    if ($_SESSION["autoriser"] == "oui") {
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

        //ajout des lignes factures (pour chaque produit acheté) dans la bd
        while ($p=$prod->fetch()){
            foreach ($_SESSION['panier'] as $key=>$value){
                if ($value!=0){
                    if($p['id_produit']==$key){
                        $linefact = $bdd->prepare('INSERT INTO lignefacture(facture_id,produit_id,quantite,prixligne) values (?,?,?,?) ');
                        $prixligne = $value*$p['prixunitaire'];
                        $linefact->execute(array($idfac,$key,$value,$prixligne));
                    }
                }
            }
        }
        //recupere les articles et leur prix
        $prod=$bdd->prepare("SELECT * From produits");
        //execute la requete
        $prod->execute();
        $init = array();
        while ($value=$prod->fetch()){
            $id=$value['id_produit'];
            $init[$id]=0;
        }
        $_SESSION['panier'] = $init;
        $_SESSION['nb_tot_art'] = 0;
        $_SESSION['tot_achat'] = 0;
    }else{
        header("location:login.php");
        exit();
    }
}
header("location:panier.php");
?>