<?php
@session_start();

//Header avec class BS
include_once("./Commons/header.php");
//connexion à la bd
include("Commons/connexionBdd.php");?>

<title>Consulter les connexions d'un UM</title>

<!-- Contenu du site-->
<div class="border m-2 p-2 ">

    <h1 class="text-center align-middle text-black">Consulter les connexions d'UM</h1>

    <?php
    @$idsearch = $_POST['idsearch'];
    @$emailsearch = $_POST['emailsearch'];
    @$loginsearch = $_POST['loginsearch'];
    @$valider = $_POST['valider'];


    if(isset($valider)){
        //si une des cases n'est pas remplie correctement, message ajouté à la variable &message
        if(empty($idsearch) && empty($emailsearch) && empty($loginsearch))
            $message="<li>Veuillez compléter le champ!</li>";
        if(empty($message)){
            //preparation de la requete de recherche dans la base de donnée si login est deja existant
            $req1 = $bdd->prepare("SELECT facture.prixtotal, facture.dateachat , users.email, users.login
                                            FROM facture
                                            INNER JOIN users
                                            ON facture.user_id=users.id_user
                                            WHERE facture.user_id=:id
                                            OR users.email=:email
                                            OR users.login=:login
                                            ORDER BY facture.dateachat DESC");

            $req1->bindValue(':id', $idsearch);
            $req1->bindValue(':email', $emailsearch);
            $req1->bindValue(':login', $loginsearch);
            $req1->execute();
        } else{?>
            <div id="message">
                <?php echo $message;?>
            </div>
        <?php }
    }
    ?>

    <form name="form" method="post" action="" class="text-right p_form pt-2">
        <div class="form-group row">
            <label for="idsearch" class="col-sm-4 col-form-label">Recherche via l'ID UM :</label>
            <input type="text" name="idsearch" id="idsearch" class="form-control col-sm-6"  placeholder="Entrez un id">
            <div class="col-sm-2">
                <input type="submit" name="valider" value="Rechercher" class="p_input" />
            </div>
        </div>
    </form>
    <form name="form2" method="post" action="" class="text-right p_form pt-2">
        <div class="form-group row">
            <label for="emailsearch" class="col-sm-4 col-form-label">Recherche via l'email UM :</label>
            <input type="text" name="emailsearch" id="emailsearch" class="form-control col-sm-6" placeholder="Entrez un login">
            <div class="col-sm-2">
                <input type="submit" name="valider" value="Rechercher" class="p_input" />
            </div>
        </div>
    </form>
    <form name="form3" method="post" action="" class="text-right p_form pt-2">
        <div class="form-group row">
            <label for="loginsearch" class="col-sm-4 col-form-label">Recherche via le login UM :</label>
            <input type="text" name="loginsearch" id="loginsearch" class="form-control col-sm-6"  placeholder="Entrez un login">
            <div class="col-sm-2">
                <input type="submit" name="valider" value="Rechercher" class="p_input" />
            </div>
        </div>
    </form>

    <!--Affichage des commentaires-->
    <table class="table table-sm table-responsive-sm table-striped">
        <thead>
        <tr>
            <th scope="col-1"></th>
            <th scope="col-5">Montant de l'achat</th>
            <th scope="col-5">Date de l'achat</th>
            <th scope="col-1">Détails</th>

        </tr>
        <tbody>
        <?php $i=1;
        if (empty($message) && isset($req1)){
            while($achat=$req1->fetch()) {
                ?>
                <tr>
                    <th scope="row"><?php echo $i?></th>
                    <td><?= $achat['prixtotal'].' €' ?></td>
                    <td><?= $achat['dateachat'] ?></td>
                    <td><?= "voir plus..." ?></td>
                </tr>
                <?php $i++;}
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>
