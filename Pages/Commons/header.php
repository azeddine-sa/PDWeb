<?php
    @session_start();
    //variable reprenant l'autorisation d'accès (si l'utilisateur s'est connecté)
    @$autoriser = $_SESSION["autoriser"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="../CSS/style.css" />
        <link rel="stylesheet" type="text/css" href="../Bootstrap/css/bootstrap.css"/>
        <link rel="icon" href="../SRC/img/s&b.png" />
    </head>
    <body>
        <header class='bg-dark text-white'>  
            <!-- Header en 3 partie '<div>' -->
            <div class="row align-items-center m-0 p-0">
                <!-- Partie gauche : logo -->
                <div class="col-2 text-center">
                    <a href="index.php">
                        <img src="../SRC/img/s&b-blanc.png" alt="logo du site" class="rounded-circle img-fluid p_logosize">
                    </a>
                </div>
                <!-- Partie centrale : menu -->
                <div class="col-8 m-0 p-0">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <!-- Menu sandwich - taille medium ecran -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <!-- Lien menu-->
                                <li class="nav-item active mr-2">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <li class="nav-item active mr-2">
                                    <a class="nav-link" href="blog.php">Blog</a>
                                </li>
                                <li class="nav-item active mr-2">
                                    <a class="nav-link" href="shop.php">Shop</a>
                                </li>
                                <li class="nav-item active mr-2">
                                    <a class="nav-link" href="minichat.php">Minichat</a>
                                </li>
                                <!-- Lien menu deroulant JS Bootstrap-->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Contact
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="../Pages/contact.php">Contactez-nous</a>
                                        <?php if($autoriser!="oui") { ?>
                                        <a class="dropdown-item" href="../Pages/inscription.php">Inscription</a>
                                        <?php } ?>
                                    </div>
                                </li>
                                <?php
                                    // Si l'utilisateur est connecté, ajout onglet "espace personnel" dans le menu
                                    if($autoriser=="oui" && $_SESSION['status']==true){ ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Menu Administration
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="../Pages/editnews.php">Ecrire une news</a>
                                                <a class="dropdown-item" href="../Pages/umconsult.php">Consulter les profils UM</a>
                                                <a class="dropdown-item" href="../Pages/umconnexion.php">Consulter les connexions d'un membre</a>
                                                <a class="dropdown-item" href="#">Consulter la liste des achats d'un membre</a>
                                                <a class="dropdown-item" href="../Pages/session.php">Mon compte</a>
                                                <a class="dropdown-item" href="../Pages/logout.php">Deconnexion</a>
                                            </div>
                                        </li>
                                <?php } elseif ($autoriser=="oui" && $_SESSION['status']==false){ ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Espace Membre
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="../Pages/session.php">Consulter/Modifier mon profil</a>
                                                <a class="dropdown-item" href="../Pages/session.php">Modifier mon mot de passe</a>
                                                <a class="dropdown-item" href="../Pages/logout.php">Deconnexion</a>
                                            </div>
                                        </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Partie droite : (de)connexion -->
                <?php
                    //logo panier
                    if(($_SESSION['nb_tot_art']==0)){?>
                        <a href="panier.php">
                            <img src="../SRC/img/icon-panier.png" alt="mon panier" class="p_logosize"/>
                        </a>
                    <?php }else{ ?>
                        <a href="panier.php">
                            <img src="../SRC/img/icon-panier-plein.png" alt="mon panier" class="p_logosize"/>
                        </a>
                    <?php }
                    //Si l'utilisateur n'est pas connecté, logo de connexion
                    if($autoriser!="oui"){ ?>
                        <a href="login.php">
                            <img src="../SRC/img/icon-user.png" alt="icon user" class="p_logosize"/>
                        </a>
                    <?php } 
                    //Si l'utilisateur est connecté, logo de deconnexion
                    else{ ?>
                        <a href="logout.php">
                            <img src="../SRC/img/log-out.png" alt="icon logout" class="p_logosize"/>
                        </a>
                    <?php }
                ?>
                    
                </div>
            </div>
        </header>
