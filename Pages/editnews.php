<?php
@session_start();

@$id_user = $_SESSION['id'];
@$titre = $_POST['titre'];
@$contenu = $_POST['contenu'];
@$valider= $_POST['valider'];

if(isset($valider)){

    //connexion à la bd
    include("Commons/connexionBdd.php");

    //preparation de la requete de recherche dans la base de donnée si login est deja existant
    $req=$bdd->prepare("INSERT into blog(user_id, titre, contenu) values (?,?,?)");

    //execute la requete avec le login saisi par l'utilisateur
    $req->execute(array($id_user, $titre, $contenu));

    $message = "Article ajouté !";?>

        <div id="message">
            <?php echo $message ?>;
        </div>
<?php }
?>
    <!-- Header avec class BS -->
<?php include_once("./Commons/header.php"); ?>

    <div class="row border m-2 p-2">

        <h1 class="col-12 text-center">Editer une news</h1>

        <!-- Formulaire minichat -->

        <form name="form" method="post" action="" class="col-10">
            <div class="form-group row">
                <label for="titre" class="col-sm-2 col-form-label">Titre</label>
                <div class="col-sm-10">
                    <input type="texte" class="form-control" name="titre" id="titre" placeholder="Entrez un titre">
                </div>
            </div>
            <div class="form-group row">
                <label for="contenu" class="col-sm-2 col-form-label">Contenu</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="contenu" id="contenu" rows="10" ></textarea>
                </div>
            </div>
            <div>
                <br/>
                <input type="submit" name="valider" value="Ajouter" class="col-12"/>
            </div>
        </form>

    </div>

    <!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?><?php
