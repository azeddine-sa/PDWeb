<?php
@session_start();

//Header avec class BS
include_once("./Commons/header.php");
include("./Commons/connexionBdd.php");
include("./PHP/codegestprod.php")?>

<title>Gestion des produits</title>

<?php if(!empty($message)){ ?>
    <div id="message"><?php echo $message ?></div>
<?php } ?>

<!-- Contenu du site-->
<h1 class="text-center align-middle text-black">Ajouter/Supprimer un produit</h1>
<div class="row border m-2 p-2">
    <div class="col-6">
        <h3 class="text-center">Ajouter un produit</h3>
        <form class="form" method="post" action="gestprod_post.php" enctype="multipart/form-data">
            <!-- Type de produit-->
            <div class="label">Type de produit : </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="1" value="1" checked>
                <label class="form-check-label" for="1">
                    Informatique
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="2" value="2">
                <label class="form-check-label" for="2">
                    Livre
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="3" value="3">
                <label class="form-check-label" for="3">
                    Hifi
                </label>
            </div>

            <!-- Nom du produit-->
            <label for="nom">Nom du produit :</label>
            <input type="text" name="nom" value ="" required>

            <!-- Description du produit-->
            <label for="desc">Description :</label>
            <input type="text" name="desc" value ="" required>

            <!-- Prix unitaire du produit-->
            <label for="pu">Prix unitaire :</label>
            <input type="number" min="0" step="0.01" name="pu"  value ="" required>

            <!-- Stock du produit-->
            <label for="stock">Stock :</label>
            <input type="number" min="0" name="stock" value ="" required>

            <!-- Disponibilité produit-->
            <label for="dispo">Article est-il disponible :</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dispo" id="1" value="1" checked>
                <label class="form-check-label" for="1">
                    OUI
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dispo" id="0" value="0">
                <label class="form-check-label" for="0">
                    NON
                </label>
            </div>

            <!-- Image du produit-->
            <label for="img">Image : </label>
            <input type="file" accept="image/*" name="img" value =""><br/>

            <div>
                <br/>
                <input type="submit" name="valider" value="Ajouter" />
            </div>
        </form>
    </div>
    <div class="col-6">
        <h3 class="text-center">Supprimer un produit</h3>
        <?php
            $prod = $bdd->prepare('SELECT * FROM produits');
            $prod->execute()
        ?>
        <form class="form" method="post" action="">
            <label for="prod_select">Choisir le produit à supprimer :</label>
            <select name="prod_select">
                <?php
                while($p=$prod->fetch()){?>
                <option value="<?php echo $p['id_produit'] ?>">
                    <?=$p['id_produit'].' - '.$p['nom']?>
                </option>
                <?php } ?>
            </select>
            <br/><br/>
            <input type="submit" name="supprimer" value="Supprimer" />
        </form>
    </div>






</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>





