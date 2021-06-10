<title> Connexion </title>

<!-- Header avec class BS -->
<?php session_start();
require("./PHP/codeconnexion.php");
include_once("./Commons/header.php"); ?>

<!-- Contenu du site-->
<div class="border m-2 p-2">
    <!-- Affichage des messages d'erreurs formulaire SI il y en a-->
    <?php if(!empty($message)){ ?>
		<div id="message"><?php echo $message ?></div>
	<?php } ?>

    <div class="p_forminscription">
        <!-- Formulaire de connexion-->
        <form name="form" method="post" action="">
            <div class="label">Adresse Email</div>
            <input type="email" name="email" value = <?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email'];} ?> >

            <div class="label">Mot de passe</div>
            <input type="password" name="pass" value = <?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?> >

            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" name="sesouvenir" id="sesouvenir">
                <label for="sesouvenir" class="form-check-label text-info">Se souvenir de moi</label>
            </div>

            <div>
                <br/>
                <input type="submit" name="valider" value="Se connecter" />
            </div>

            <div>
                <br/>
                <button type="button">
                    <a href="inscription.php" class="text-white">Créer un compte</a>
                </button>
            </div>

            <a href="password_forget.php">Mot de passe oublié</a>
        </form>
    </div>
</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>