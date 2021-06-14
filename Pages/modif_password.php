<?php
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
  	$oldpass = $_POST['oldpassword'];
  	$newpass = $_POST['newpassword'];

  	$req = $bdd->prepare('SELECT * FROM pdweb.users WHERE id_user = :login');

    $req->bindvalue(':login', $id);
    $req->execute();
    $result = $req->fetch();

    $passwordisok = password_verify($oldpass, $result['pass']);


      if(!$passwordisok){
          $message = "Ancien mot de passe invalide";
      }
      elseif(empty($_POST['newpassword']) || $_POST['newpassword'] != $_POST['newpassword2'])
      {
          $message = "Rentrer un mot de passe valide";
      }
      else {
          $newpass = password_hash($newpass, PASSWORD_DEFAULT);

          $requete = $bdd->prepare('UPDATE users SET pass = :password WHERE id_user=:id_user' );

          $requete->bindvalue(':password', $newpass);
          $requete->bindvalue(':id_user', $id);

          $requete->execute();

          $message = "Les modifications ont été pris en comptes";
      }
  }
?>

<h3 class="text-center text-black pt-5 pb-3 ">Modification du mot de passe</h3>

<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center ">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <?php
                    if(isset($message)) { ?>
                    <div id="message">
                        <?php echo $message ?>;
                    </div>
                    <?php }

                    $requete = $bdd->prepare('SELECT * FROM pdweb.users WHERE email=:email');
                    $requete->execute(array('email'=>$_SESSION['email'] ));
                    $result = $requete->fetch();
                    $_SESSION['password'] = $result['pass'];
                    ?>

                    <form id="login-form" class="form" action="" method="post">
                        <div class="form-group">
                            <label for="oldpassword" class="text-info">Ancien Mot de passe:</label><br>
                            <input type="password" name="oldpassword" id="oldpassword" class="form-control" >
                        </div>
                        <div class="form-group">
                              <label for="newpassword" class="text-info">Nouveau Mot de passe:</label><br>
                              <input type="password" name="newpassword" id="newpassword" class="form-control" >
                        </div>
                        <div class="form-group">
                              <label for="newpassword2" class="text-info">Confirmation du mot de passe:</label><br>
                              <input type="password" name="newpassword2" id="newpassword2" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="modification" class="btn btn-info btn-md" value="Modifier">
                        </div>
                        <div class="form-group">
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
