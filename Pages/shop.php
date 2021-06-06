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


    foreach ($req as $key=>$value){?>
       <h3><?= "{$key}" ?></h3>
        <div class="row m-1 p-1">
            <?php while($prod=$value->fetch()){ ?>
                <div class="col-sm-3 col-md-2 p-2 border">
                    <?php $i = 1; ?>
                    <p class=p_pprod"><?= $prod["nom"]; ?> </p>
                    <!-- <p class="text-center">Description<br/> <?php echo substr($prod["description"],0,90).'...';; ?> </p> -->
                    <div>
                        <img src="<?= $prod["img"]; ?>" class="img-thumbnail" alt="" name="prod">
                        <p class="text-center text-danger"><?= number_format($prod["prixunitaire"],2).'€'; ?></p>
                        <?php $i++; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>





