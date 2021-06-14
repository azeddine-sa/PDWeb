<?php
if($_SESSION['status']!=true){?>
    <br/><br/><br/><br/>
    <h1 class="text-center text-danger">!!! Vous n'êtes pas autorisé à acceder à cette page !!!</h1>
    <?php header('Refresh: 2; URL=index.php');
    exit();
}
require 'commons/header.php';
require 'Commons/connexionBdd.php';
?>
<title>Modification du Profil</title>

<?php
if(isset($_POST['modification']) AND isset($_GET['id']) AND $_SESSION['status']==1)
{
    $id = $_GET['id'];

    $requete = $bdd->prepare('UPDATE users SET login=:login, email=:email, nom=:nom, prenom=:prenom, adresse=:adresse,
                 cp=:cp, commune=:commune, datenaissance=:datenaissance, status=:status, indesirable=:indesirable WHERE id_user=:id' );
    //login = :login, pass = :password
    $requete->bindvalue(':login', $_POST['login']);
    $requete->bindvalue(':email', $_POST['email']);
    $requete->bindvalue(':nom', $_POST['nom']);
    $requete->bindvalue(':prenom', $_POST['prenom']);
    $requete->bindvalue(':adresse', $_POST['adresse']);
    $requete->bindvalue(':cp', $_POST['cp']);
    $requete->bindvalue(':commune', $_POST['commune']);
    $requete->bindvalue(':datenaissance', $_POST['ddn']);
    $requete->bindvalue(':status', $_POST['status']);
    $requete->bindvalue(':indesirable', $_POST['indesirable']);
    $requete->bindvalue(':id', $id);

    $requete->execute();

    $message = "Les modifications ont été pris en comptes";
}
?>

<h3 class="text-center text-black pt-5">Modification du profil</h3>

<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <?php
                    if(isset($message)){ ?>
                        <div id="message">
                            <?php echo $message ?>;
                        </div>
                    <?php }
                    $requete = $bdd->prepare('SELECT * FROM pdweb.users WHERE id_user=:user_id');
                    $requete->bindvalue(':user_id', $_GET['id']);
                    $requete->execute();
                    $result = $requete->fetch();
                    ?>

                    <form id="login-form" class="form" action="" method="post">
                        <div class="form-group">
                            <label for="login" class="text-info">Login:</label><br>
                            <input type="text" name="login" id="login" class="form-control" value="<?=$result['login']?>">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input type="text" name="email" id="email" class="form-control" value="<?=$result['email']?>">
                        </div>
                        <div class="form-group">
                            <label for="nom" class="text-info">Nom:</label><br>
                            <input type="text" name="nom" id="nom" class="form-control" value="<?=$result['nom']?>">
                        </div>
                        <div class="form-group">
                            <label for="prenom" class="text-info">Prénom:</label><br>
                            <input type="text" name="prenom" id="prenom" class="form-control" value="<?=$result['prenom']?>">
                        </div>
                        <div class="form-group">
                            <label for="adresse" class="text-info">Adrese:</label><br>
                            <input type="text" name="adresse" id="adresse" class="form-control" value="<?=$result['adresse']?>">
                        </div>
                        <div class="form-group">
                            <label for="cp" class="text-info">Code postal:</label><br>
                            <input type="text" name="cp" id="cp" class="form-control" value="<?=$result['cp']?>">
                        </div>
                        <div class="form-group">
                            <label for="commune" class="text-info">Commune:</label><br>
                            <input type="text" name="commune" id="commune" class="form-control" value="<?=$result['commune']?>">
                        </div>
                        <div class="form-group">
                            <label for="ddn" class="text-info">Date de naissance:</label><br>
                            <input type="date" name="ddn" id="ddn" class="form-control" value="<?=$result['datenaissance']?>">
                        </div>
                        <div class="form-group">
                            <label for="status" class="text-info">Status:</label><br>
                            <input type="text" name="status" id="status" class="form-control" value="<?=$result['status']?>">
                        </div>
                        <div class="form-group">
                            <label for="indesirable" class="text-info">Indesirable:</label><br>
                            <input type="text" name="indesirable" id="indesirable" class="form-control" value="<?=$result['indesirable']?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="modification" class="btn btn-info btn-md" value="Modifier">
                        </div>
                        <div class="form-group center">
                            <a href="umconsult.php" class="btn btn-info btn-md" role="button" aria-pressed="true">Annuler</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>
