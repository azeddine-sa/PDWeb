<?php
@session_start();
//Header avec class BS
include_once("./Commons/header.php");

//connexion à la bd
include("./Commons/connexionBdd.php");

var_dump($_SESSION['tot_achat']);
?>
<title> shop </title>

<h1 class="text-center text-black"> Shop en ligne</h1>

<!-- Contenu du site-->
<div class="border m-2 p-2 ">
    <h3>Votre panier</h3>

    <?php
    $totalpanier = 0;
    $prod=$bdd->prepare("SELECT * From produits");
    //execute la requete
    $prod->execute(); ?>

    <div class="row">
        <div class="col-12">
            <table class="table table-image">
                <thead>
                <tr class="text-center">
                    <th scope="col">Image</th>
                    <th scope="col">Produit</th>
                    <th scope="col">Prix Unitaire</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Total</th>
                    <th></th>
                </tr>
                </thead>
                <?php if($_SESSION['nb_tot_art']!=0){
                    while ($p=$prod->fetch()){
                        foreach ($_SESSION['panier'] as $key=>$value){
                            if ($value!=0){
                                if($p['id_produit']==$key){?>
                                <tbody>
                                    <tr class="text-center mt-auto mb-auto">
                                        <td class="w-25">
                                            <img src="<?= $p["img"]; ?>" class="p_sizeImgShop" alt="" name="prod">
                                        </td>
                                        <td><?= $p["nom"]; ?> </td>
                                        <td><?= number_format($p["prixunitaire"],2).'€'?></td>
                                        <td><?= $value?></td>
                                        <td>
                                            <?= (floatval($value)*$p["prixunitaire"]).'€';?>
                                            <?php $totalpanier += (floatval($value)*$p["prixunitaire"]);?>
                                        </td>
                                        <td>
                                            <a href="./panier_post.php?cle=<?=$key?>"> <img src="../SRC/img/delete.png" class="p_sizeImgDelete" alt="" name="delete"> </a>
                                        </td>
                                    </tr>

                                <?php }
                            }
                        }
                    } ?>
                        <tr class="text-center mt-auto mb-auto">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> TOTAL :</td>
                            <td><?= $totalpanier.'€'; ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                <?php }else{ ?>
                    <tbody>
                        <td class="mt-auto mb-auto">
                            Votre panier est vide!
                        </td>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <form method="post" action="panier_post.php">
        <input type="submit" value="Vider le panier" name='videpanier' class="p_input3 d-inline-block"/>
        <input type="submit" value="Valider le panier" name='validerpanier' class="p_input3 d-inline-block"/>
    </form>

</div>


