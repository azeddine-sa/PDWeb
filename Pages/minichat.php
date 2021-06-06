<?php
include("./Commons/header.php");
include("./Commons/connexionBdd.php");
require("./PHP/codeminichat.php");; ?>

<div class="border m-2 p-2">

    <h1 class="text-center">Mini-Chat</h1>

    <!-- Affichage minichat -->

    <div class ="minichat">
        <?php
        //connexion à la bd
        include("Commons/connexionBdd.php");

        //preparation de la requete de recherche dans la base de donnée si login est deja existant
        $req=$bdd->prepare("SELECT pseudo, messagechat 
                                FROM (SELECT * FROM minichat ORDER BY id_chat DESC limit 10) minichat
                                ORDER BY id_chat");

        //execute la requete avec le login saisi par l'utilisateur
        $req->execute();


        //tableau reprenant la rechercher ligne par ligne
         $tab=$req->fetch();
         ?>
        <div class="minichatmsg row">
            <?php
            do{ ?>
                <div class="col-1 text-right" >
                    <?php echo '<p><strong>'.htmlspecialchars($tab["pseudo"]).'</strong>:';?>
                </div>
                <div class="col-11 border-bottom pt-1" >
                    <?php echo htmlspecialchars($tab["messagechat"]); ?>
                </div>
                <?php
            }while($tab=$req->fetch());
            ?>
        </div>
    </div>

    <!-- Formulaire minichat -->

    <form name="form" method="post" action="" class="text-center">
        <div class="label ">Tapez votre message :
            <input type="text" name="msg" size="100"/>
        <div>
            <br/>
            <input type="submit" name="valider" value="Envoyer" />
        </div>
    </form>

</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>