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
    foreach ($req as $key=>$value){?>
       <h3><?= "{$key}" ?></h3>
        <div class="row m-1 p-1">
            <?php while($prod=$value->fetch()){ ?>
                <div class="col-sm-3 col-md-2 p-2 border">
                    <?php
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
                    <?php $id[]=$idprod; ?>
                </div>
                <?php
            } ?>
        </div>
    <?php
    } ?>
</div>

<?php
foreach ($id as $value){
    $a='ok'.$value;
    if(isset($_POST[$a])){
        @$nb=$_POST['nb'];
        @$total=($_POST['nb']*$prod['prixunitaire']);
        @$_SESSION['nb_tot_art']+=$nb;
        @$_SESSION['tot_achat']+=$total;
        @$_SESSION['panier'][$value]+=$nb;
    }
}
//<!-- Pied de page-->
include_once("./Commons/footer.php");
?>





