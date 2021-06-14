<?php
@session_start();

//Header avec class BS
include_once("./Commons/header.php");
//connexion à la bd
include("Commons/connexionBdd.php");
if($_SESSION['autoriser']!=true){?>
    <br/><br/><br/><br/>
    <h1 class="text-center text-danger">!!! Vous n'êtes pas autorisé à acceder à cette page !!!</h1>
    <?php header('Refresh: 2; URL=index.php');
    exit();
}?>

<title>Consulter mes achats</title>

<!-- Contenu du site-->
<div class="border m-2 p-2 ">

    <h1 class="text-center align-middle text-black">Consulter les factures d'un UM</h1>

    <?php
    @$iduser = $_SESSION['id'];

    $req1 = $bdd->prepare("SELECT facture.id_facture, facture.prixtotal, facture.dateachat , users.email, users.login
                                            FROM facture
                                            INNER JOIN users
                                            ON facture.user_id=users.id_user
                                            WHERE facture.user_id=:id
                                            ORDER BY facture.dateachat DESC");
    $req1->bindValue(':id', $iduser);
    $req1->execute();

    //Affichage des achats
        while($achat=$req1->fetch()) {
            $idfac = $achat['id_facture'];
            $totfac = $achat['prixtotal']?>
            <h3> Facture du <?= $achat['dateachat']?> </h3>
            <!-- détail de facture -->
            <!--Affichage des achats-->
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
                $req2 = $bdd->prepare("SELECT lignefacture.produit_id, lignefacture.quantite, lignefacture.prixligne, produits.prixunitaire, produits.nom
                                            FROM lignefacture
                                            INNER JOIN produits
                                            ON lignefacture.produit_id=produits.id_produit
                                            WHERE facture_id=:idf");
                $req2->bindValue(':idf', $idfac);
                $req2->execute();
                while($detail=$req2->fetch()) {
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
                    <td><?= $achat['prixtotal'].' €' ?></td>
                </tr>
                </tbody>
            </table>
        <?php }
    ?>



</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>

