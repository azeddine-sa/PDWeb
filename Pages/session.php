<title> Profil </title>

<?php
    session_start();
    //si l'utilisateur n'est pas connecté, redirection vers la page de connexion
	if(@$_SESSION["autoriser"]!="oui"){
		header("location:login.php");
		exit();
	}
?>

<!-- Header avec class BS -->
<?php include_once("./Commons/header.php"); ?>

<!-- Contenu du site-->
<div class="border m-2 p-2 text-center">
    <h1>
        <?php 
            echo (date("H")<18)?("Bonjour"):("Bonsoir");
        ?>
        <span>
        <?=$_SESSION["nomPrenom"]?>
        </span>
    </h1>

    <h2 class="text-center">
        Mon profil
    </h2>
    <div class="row">
        <!-- Login -->
        <div class="col-6 pb-1 text-right"> Login utilisateur : </div>
        <div class="col-5 text-left"> <?=$_SESSION['login'] ?> </div>

        <!-- Nom -->
        <div class="col-6 pb-1 text-right"> Nom : </div>
        <div class="col-6 text-left"> <?=$_SESSION['nom'] ?> </div>

        <!-- Prénom -->
        <div class="col-6 pb-1 text-right"> Prénom : </div>
        <div class="col-6 text-left"> <?=$_SESSION['prenom'] ?> </div>

        <!-- Email -->
        <div class="col-6 pb-1 text-right"> Adresse email : </div>
        <div class="col-6 text-left"> <?=$_SESSION['email'] ?> </div>

        <!-- Adresse -->
        <div class="col-6 pb-1 text-right"> Adresse : </div>
        <div class="col-6 text-left"> <?=$_SESSION['adresse'] ?> </div>

        <!-- CP - Commune -->
        <div class="col-6 pb-1 text-right"> Code Postal : </div>
        <div class="col-6 text-left"> <?=$_SESSION['cp'] ?> - <?=$_SESSION['commune'] ?> </div>

        <!-- Date de naissance -->
        <div class="col-6 pb-1 text-right"> Date de naissance : </div>
        <div class="col-6 text-left"> <?=$_SESSION['ddn'] ?> </div>

        <!-- Modifier profil -->
        <div class="col-12 text-center"><a href="modif_profil.php"> Modifier mon profil </a></div>
        <!-- Modifier mot de passe -->
        <div class="col-12 text-center"><a href="modif_password.php"> Modifier mon mot de passe </a></div>
    </div>
</div>





<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>