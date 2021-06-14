<?php
session_start();
if($_SESSION['autoriser']!=true){?>
    <br/><br/><br/><br/>
    <h1 class="text-center text-danger">!!! Vous n'êtes pas autorisé à acceder à cette page !!!</h1>
    <?php header('Refresh: 2; URL=index.php');
    exit();
}
require 'commons/header.php';
require'Commons/connexionBdd.php'?>
<title>Modification du Profil</title>

<?php
  if(isset($_POST['modification']) AND isset($_SESSION['id']))
  {
  	$id = $_SESSION['id'];

      $requete = $bdd->prepare('UPDATE users SET nom=:nom, prenom=:prenom, adresse=:adresse,
                 cp=:cp, commune=:commune, datenaissance=:datenaissance WHERE id_user=:id_user' );
      //login = :login, pass = :password

      $requete->bindvalue(':nom', htmlspecialchars($_POST['nom']));
      $requete->bindvalue(':prenom', htmlspecialchars($_POST['prenom']));
      $requete->bindvalue(':adresse', htmlspecialchars($_POST['adresse']));
      $requete->bindvalue(':cp', htmlspecialchars($_POST['cp']));
      $requete->bindvalue(':commune', htmlspecialchars($_POST['commune']));
      $requete->bindvalue(':datenaissance', $_POST['ddn']);
      $requete->bindvalue(':id_user', $id);

      $requete->execute();

      $message = "Les modifications ont été pris en comptes";

/*    if(empty($_POST['login']) || !preg_match('/[a-zA-Z0-9]+/', $_POST['login']))
    {
     $message = 'Votre login doit être une chaine de caractéres (alphanumérique) !';
    }
    elseif(empty($_POST['password']) || $_POST['password'] != $_POST['password2'])
    {
     $message = "Rentrer un mot de passe valide";
    }
    else
    {
      require_once 'Commons/connexionBdd.php';

      $req = $bdd->prepare('SELECT * FROM pdweb.users WHERE login = :login');

      $req->bindvalue(':login', $_POST['login']);
      $req->execute();
      $result = $req->fetch();

      if($result)
      {
       	$message = "Le nom d'utilisateur que vous avez choisi est déjà pris";
      }
      else
      {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


      }
    }*/
  }
?>

<h3 class="text-center text-black pt-5">Modification du profil</h3>

<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <?php if(isset($message)) { ?>
                        <div id="message">
                            <?php echo $message ?>;
                        </div>
                    <?php }
                    $requete = $bdd->prepare('SELECT * FROM pdweb.users WHERE email=:email');
                    $requete->execute(array('email'=>$_SESSION['email'] ));
                    $result = $requete->fetch();
                    $_SESSION['nom'] = $result['nom'];
                    $_SESSION['prenom'] = $result['prenom'];
                    $_SESSION['adresse'] = $result['adresse'];
                    $_SESSION['cp'] = $result['cp'];
                    $_SESSION['commune'] = $result['commune'];
                    $_SESSION['ddn'] = $result['datenaissance'];?>

                    <form id="login-form" class="form" action="" method="post">
                        <div class="form-group">
                          <label for="nom" class="text-info">Nom:</label><br>
                          <input type="text" name="nom" id="nom" class="form-control" value="<?=$_SESSION['nom'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="prenom" class="text-info">Prénom:</label><br>
                            <input type="text" name="prenom" id="prenom" class="form-control" value="<?=$_SESSION['prenom'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="adresse" class="text-info">Adrese:</label><br>
                            <input type="text" name="adresse" id="adresse" class="form-control" value="<?=$_SESSION['adresse'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="cp" class="text-info">Code postal:</label><br>
                            <input type="text" name="cp" id="cp" class="form-control" value="<?=$_SESSION['cp'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="commune" class="text-info">Commune:</label><br>
                            <input type="text" name="commune" id="commune" class="form-control" value="<?=$_SESSION['commune'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="ddn" class="text-info">Date de naissance:</label><br>
                            <input type="date" name="ddn" id="ddn" class="form-control" value="<?=$_SESSION['ddn'] ?>">
                        </div>


                    <!--
                    <div class="form-group">
                          <label for="password" class="text-info">Mot de passe:</label><br>
                          <input type="password" name="password" id="password" class="form-control" >
                    </div>
                    <div class="form-group">
                          <label for="password2" class="text-info">Confirmation du mot de passe:</label><br>
                          <input type="password" name="password2" id="password2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password2" class="text-info">Confirmation du mot de passe:</label><br>
                        <input type="password" name="password2" id="password2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-info">Confirmation du mot de passe:</label><br>
                        <input type="password" name="password2" id="password2" class="form-control">
                    </div>
                        <div class="form-group">
                            <label for="password2" class="text-info">Confirmation du mot de passe:</label><br>
                            <input type="password" name="password2" id="password2" class="form-control">
                        </div> -->
                        <div class="form-group">
                              <input type="submit" name="modification" class="btn btn-info btn-md" value="Modifier">
                        </div>
                        <div class="form-group center">
                            <a href="session.php" class="btn btn-info btn-md" role="button" aria-pressed="true">Annuler</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>
