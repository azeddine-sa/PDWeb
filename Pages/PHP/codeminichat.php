<?php
@session_start();

//Si l'utilisateur n'est pas connecté, redirection vers index.php
if(@$_SESSION["autoriser"]!="oui"){
    header("location:login.php");
    exit();
}
@$msg = $_POST["msg"];
@$pseudo = $_SESSION["login"];
@$message ="";
@$valider=$_POST["valider"];


if(isset($valider)){
    //si une des cases n'est pas remplie correctement, message ajouté à la variable &message
    if(empty($msg)) $message="<li>veuillez ecrire un message!</li>";

    if(empty($message)){
        //preparation de la requete de recherche dans la base de donnée si login est deja existant
        $req=$bdd->prepare("INSERT into minichat(pseudo, messagechat) values (?,?)");

        //execute la requete avec le login saisi par l'utilisateur
        $req->execute(array($pseudo, $msg));
        "location:minichat_post.php";
    }else{?>
        <div id="message">
            <?php echo $message; ?>
        </div>
    <?php }
} ?>