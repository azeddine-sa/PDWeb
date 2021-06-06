<?php
@session_start();
$id = $_GET['id'];
@$id_user = $_SESSION['id'];
@$titre = $_POST['titre'];
@$contenu = $_POST['msg'];
@$valider= $_POST['valider'];



if(isset($valider)){

    //connexion à la bd
    include("Commons/connexionBdd.php");

    //preparation de la requete de recherche dans la base de donnée si login est deja existant
    $req=$bdd->prepare("INSERT into commentaires(news_id, user_id, commentaire, datecommentaire) values (?,?,?,now())");

    //execute la requete avec le login saisi par l'utilisateur
    $req->execute(array($id, $id_user, $contenu));
}

//preparation de la requete de recherche dans la base de donnée des produits
$req1=$bdd->prepare('SELECT * FROM blog WHERE id_news = ?');
//execute la requete avec le login saisi par l'utilisateur
$req1->execute(array($id));


$req2=$bdd->prepare("SELECT users.login, commentaires.commentaire, commentaires.datecommentaire 
                                            FROM commentaires
                                            INNER JOIN users
                                            ON commentaires.user_id=users.id_user
                                            WHERE commentaires.news_id=:idnews
                                            ORDER BY commentaires.datecommentaire DESC");
$req2->bindValue(':idnews',$id);
$req2->execute();


?>