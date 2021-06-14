    <!-- Header avec class BS -->
    <?php
    session_start();
        require("./PHP/codeconnexionindex.php");
        include_once("./Commons/header.php");
        require_once ('Commons/connexionBdd.php');

    //Si la variable de session nb tot article n'existe pas, initialisation à 0
    if(!isset($_SESSION['nb_tot_art']))
        $_SESSION['nb_tot_art'] = 0;
    //Si la variable de session total achat n'existe pas, initialisation à 0
    if(!isset($_SESSION['tot_achat']))
        $_SESSION['tot_achat'] = 0;
    //Si la variable de session nb tot article n'existe pas, initialisation à non
    if(!isset($_SESSION['autoriser']))
        $_SESSION['autoriser']='non';
    //Si la variable de session status n'existe pas, initialisation à false
    if(!isset($_SESSION['status']))
        $_SESSION['status']=false;

    //recupere les articles et leur prix
    $prod=$bdd->prepare("SELECT * From produits");
    //execute la requete
    $prod->execute();
    $init = array();
    while ($value=$prod->fetch()){
        $id=$value['id_produit'];
        $init[$id]=0;
    }
    if(!isset($_SESSION['panier']))
        $_SESSION['panier'] = $init;

    ?>
    <title> Acceuil </title>

    <!-- Contenu du site-->
    <div class="border m-2 p-2 ">  
        <?php
        //Affichage des messages d'erreurs formulaire SI il y en a-->
        if(!empty($message)){ ?>
            <div id="message"><?php echo $message ?></div>
        <?php }?>
        <h1 class="text-center text-black"> Bienvue sur Sa&Ben.be</h1>
        <?php
        ///si l'utilisateur est pas connecté
        //infos & espace connexion
        if(@$_SESSION["autoriser"]!="oui"){?>
            <div class="row">
                <div class="p_forminscription " >
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
                            <button type="button" >
                                <a href="inscription.php" class="text-white">Créer un compte</a>
                            </button>
                        </div>

                        <a href="password_forget.php">Mot de passe oublié</a>
                    </form>
                </div>

                <div class="text-center col-sm-12 col-md-6 ">
                    <p class="font-weight-bold">Sur ce site, vous aurez la possiblité de :</p>
                    <ul class="text-left">
                        <li>Consulter notre blog</li>
                        <li>Consulter notre catalogue de produit</li>
                    </ul>
                    <p class="font-weight-bold"> Mais aussi, pour les utilisateurs connectés, de : </p>
                    <ul class="text-left">
                        <li>Faire des achats</li>
                        <li>De pouvoir commenter nos articles du blog</li>
                        <li>D'avoir accès à notre minichat</li>
                    </ul>
                </div>
            </div>
        <?php }
        //si l'utilisateur n'est pas connecté
        //affiche l'espace de connexion
        elseif (@$_SESSION["autoriser"]=="oui"){ ?>
            <div class="text-center col-12">
                <p class="font-weight-bold">Sur ce site, vous aurez la possiblité de :</p>
                <ul class="text-left col-md-12 p-4">
                    <li>Consulter notre blog</li>
                    <li>Consulter notre catalogue de produit</li>
                </ul>
                <p class="font-weight-bold"> Mais aussi, en tant qu'utilisateur connecté, de : </p>
                <ul class="text-left">
                    <li>Faire des achats</li>
                    <li>De pouvoir commenter nos articles du blog</li>
                    <li>D'avoir accès à notre minichat</li>
                </ul>
            </div>
        <?php } ?>
    </div >

    <!-- Pied de page-->
    <?php include_once("./Commons/footer.php"); ?>