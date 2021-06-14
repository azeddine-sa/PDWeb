<?php
@session_start();

//Header avec class BS
include_once("./Commons/header.php");

//connexion à la bd
include("./Commons/connexionBdd.php");

require("./PHP/codeshop.php");

?>

<!-- Contenu du site-->
<div class="border m-2 p-2 ">

    <h1 class="text-center align-middle text-black">E-Shop</h1>

    <?php
    $id=array();
    //foreach sur $req qui est un tableau de 3 requetes dont chacune à une clé correspondant à la catégorie de l'article
    //$req provient de codeshop.php
    foreach ($req as $key=>$value){?>
        <!-- affiche chaque clé (informatiques,livres,hifi) -->
       <h3><?= "{$key}" ?></h3>
        <div class="row m-1 p-1">
            <!-- $Values est un tableau de produits -->
            <?php while($prod=$value->fetch()){ ?>
                <div class="col-sm-3 col-md-2 p-2 border">
                    <?php
                    //variable qui reprend l'id
                    $idprod=$prod["id_produit"];
                    ?>
                    <p class="p_pprod"><?= $prod["nom"]; ?> </p>
                    <!-- <p class="text-center">Description<br/> <?php echo substr($prod["description"],0,90).'...';; ?> </p> -->
                    <div>
                        <img src="<?= $prod["img"]; ?>" class="img-thumbnail" alt="" name="prod">
                        <p class="text-center text-danger"><?= number_format($prod["prixunitaire"],2).'€'; ?></p>
                    </div>
                    <form method="post" action="">
                        <select name="nb" class="text-center">
                            <option value="0"> 0 </option>
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                            <option value="9"> 9 </option>
                            <option value="10"> 10 </option>
                        </select>
                        <input type="submit" value="Ajouter au panier" name='ok<?=$idprod?>' class="p_input3"/>
                    </form>
                    <?php
                        //création d'un tableau qui reprend tout les id afficher
                        $id[]=$idprod;
                    ?>
                </div>
                <?php
            } ?>
        </div>
    <?php
    } ?>
</div>

<?php
//Ajout au panier à la suite du post (l'utilisateur appuie sur ajouter un produit)
foreach ($id as $value){
    //varibale qui reprend chaque id qui correspond à la valeur "name" du input submit pour chaque produit
    $a='ok'.$value;
    if(isset($_POST[$a])){
        @$nb=$_POST['nb'];
        //Recuperer le prix unitaire du produit dans la bd via l'id produit
        @$reqpu=$bdd->prepare('SELECT prixunitaire FROM produits WHERE id_produit=?');
        @$reqpu->execute(array($value));
        @$tab=$reqpu->fetchAll();
        @$pu = 0;
        foreach ($tab as $valeur)
            $pu=$valeur['prixunitaire'];

        @$total=($nb*$pu);
        @$_SESSION['nb_tot_art']+=$nb;
        @$_SESSION['tot_achat']+=$total;
        @$_SESSION['panier'][$value]+=$nb;
        header('location:shop.php');
        exit();
    }
}
//<!-- Pied de page-->
include_once("./Commons/footer.php");
?>





