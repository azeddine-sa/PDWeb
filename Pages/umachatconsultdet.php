<?php
@session_start();

//Header avec class BS
include_once("./Commons/header.php");
//connexion à la bd
include("Commons/connexionBdd.php");
if($_SESSION['status']!=true){?>
    <br/><br/><br/><br/>
    <h1 class="text-center text-danger">!!! Vous n'êtes pas autorisé à acceder à cette page !!!</h1>
    <?php header('Refresh: 2; URL=index.php');
    exit();
}?>

<title>Détails de la facture</title>

<!-- Contenu du site-->
<div class="border m-2 p-2 ">

    <h1 class="text-center align-middle text-black">Détails de la facture</h1>

    <?php
    @$idfac = $_GET['idfac'];
    @$totfac = $_GET['totfac'];

    $req1 = $bdd->prepare("SELECT lignefacture.produit_id, lignefacture.quantite, lignefacture.prixligne, produits.prixunitaire, produits.nom
                                            FROM lignefacture
                                            INNER JOIN produits
                                            ON lignefacture.produit_id=produits.id_produit
                                            WHERE facture_id=:idf");
    $req1->bindValue(':idf', $idfac);
    $req1->execute();
    ?>
    <table class="table table-sm table-responsive-sm table-striped">
        <thead>
        <tr>
            <th scope="col-1"></th>
            <th scope="col-5">Nom du produit</th>
            <th scope="col-5">QTE</th>
            <th scope="col-1">PU</th>
            <th scope="col-1">Total</th>
        </tr>
        <tbody>
        <?php
        while($detail=$req1->fetch()) {
            ?>
            <tr>
                <th scope="row"></th>
                <td width="70%"><?= $detail['nom']?></td>
                <td width="10%"><?= $detail['quantite']?></td>
                <td width="10%"><?= $detail['prixunitaire'].' €'?></td>
                <td width="10%"><?= $detail['prixligne'].' €'?></td>
            </tr>
        <?php }
        ?>
        <tr>
            <th scope="row"></th>
            <td colspan="3" class="text-center">TOTAL facture :</td>
            <td><?=$totfac.' €'?></td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>

