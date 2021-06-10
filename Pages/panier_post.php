<?php
@session_start();

if ((isset($_POST['videpanier']))) {
    foreach ($_SESSION['panier'] as $key => $value)
        $_SESSION['panier'][$key] = 0;
    $_SESSION['nb_tot_art'] = 0;
    $_SESSION['total_achats'] = 0;
}

if(isset($_GET['cle'])){
    $cle = $_GET['cle'];
    $_SESSION['panier'][$cle] = 0;
}
header("location:panier.php");
?>