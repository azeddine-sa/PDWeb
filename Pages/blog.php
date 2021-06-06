<?php
@session_start();

//Header avec class BS
include_once("./Commons/header.php");
//connexion à la bd
include("Commons/connexionBdd.php");
include("./PHP/codeblog.php")?>

<!-- Titre de la page-->
<title>Blog</title>

<!-- Contenu du site-->
<div class="border m-2 p-2 ">

    <h1 class="text-center align-middle text-black">Blog</h1>

    <!-- Affichage articles/news -->
    <?php while($news=$req1->fetch()) {?>
        <div class="border mb-3 w-70 divblog">
            <p class="text-center border-bottom blogtitre">
                <?= htmlspecialchars($news["titre"]); ?>
            </p>
            <!-- nl2br permet de convertir les retours à la ligne en <br/> -->
            <div class="blogcontenu">
                <p class="text-center">
                    <?= substr(html_entity_decode($news["contenu"]), 0, 300).' ... '; ?>
                    <a href="articleBlog.php?id=<?= $news["id_news"];?>">Lire la suite</a>
                </p>
            </div>

            <div>

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
                    include("./PHP/codeblog2.php");
                    while($com=$req2->fetch()) { ?>
                        <tr>
                            <th scope="row"><?php echo $com['login'] ?></th>
                            <td><?php echo $com['commentaire'] ?></td>
                            <td><?php echo $com['datecommentaire'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

    <?php } ;
    ?>

</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>





