<?php
//Header avec class BS
include_once("./Commons/header.php");
//connexion à la bd
include("./Commons/connexionBdd.php");
include("./PHP/codearticleblog.php");
?>

<!-- Titre de la page-->
<title>Article Blog</title>

<!-- Contenu du site-->
<div class="border m-2 p-2 ">

    <?php while($article=$req1->fetch()) {?>
        <div class="border">
            <h2 class="text-center border-bottom"><?= htmlspecialchars($article["titre"]); ?></h2>
            <!-- nl2br permet de convertir les retours à la ligne en <br/> -->
            <div class="text-danger">
                <p class="text-center"><?= nl2br(htmlspecialchars_decode($article["contenu"])); ?></p>
            </div>

            <!--Affichage des commentaires-->
            <table class="table table-sm table-responsive-sm table-striped">
                <thead>
                <tr>
                    <th scope="col">Ecrit par</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Le</th>
                </tr>
                <tbody>
                <?php
                while($com=$req2->fetch()) { ?>
                    <tr>
                        <th scope="row"><?php echo $com['login'] ?></th>
                        <td><?php echo $com['commentaire'] ?></td>
                        <td><?php echo $com['datecommentaire'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php if(@$_SESSION["autoriser"]=="oui"){ ?>
                <div>
                    <p class="ml-2">Ajouter un commentaire : </p>
                    <form name="form" method="post" action="" class="text-center p_form">
                        <input type="text" name="msg"/>
                        <div>
                            <br/>
                            <input type="submit" name="valider" value="Envoyer" />
                        </div>
                    </form>
                </div>
            <?php } ?>

        </div>

    <?php }
    ?>

</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>





