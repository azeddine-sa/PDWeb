<title> Inscription </title>

<?php
@session_start();

//Header avec class BS
include_once("./Commons/header.php");
//connexion à la bd
include("./Commons/connexionBdd.php");
include("./PHP/codeinscription.php");
?>

<!-- Header avec class BS -->
<?php include_once("./Commons/header.php"); ?>

<!-- Contenu du site-->
<div class="border m-2 p-2"> 
    <!-- Affichage des messages d'erreurs formulaire SI il y en a-->
    <?php if(!empty($message)){ ?>
            <div id="message"><?php echo $message ?></div>
    <?php } ?>

    <?php if(!empty($message1)){ ?>
            <div id="message"><?php echo $message1 ?></div>
    <?php } ?>

    <!-- Formulaire d'inscription-->
    <form name="fo" method="post" action="" enctype="multipart/form-data">
        <div class="label">Nom</div>
            <input type="text" name="nom"/>

        <div class="label">Prénom</div>
            <input type="text" name="prenom"/>

        <div class="label">Login</div>
            <input type="text" name="login" value="<?php echo $login?>"/>

        <div class="label">Adresse Email</div>
            <input type="email" name="email"/>

        <div class="label">Mot de passe</div>
            <input type="password" name="pass"/>
        
        
        <div class="label">Confirmation du mot de passe</div>
            <input type="password" name="repass"/>
        
        <div>
            <br/>
            <input type="submit" name="valider" value="S'inscrire" />
        </div>
    </form>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>