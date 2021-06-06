<?php
// SQL affichage commentaires
$req2 = $bdd->prepare("SELECT users.login, commentaires.commentaire, commentaires.datecommentaire 
                                            FROM commentaires
                                            INNER JOIN users
                                            ON commentaires.user_id=users.id_user
                                            WHERE commentaires.news_id=:idnews
                                            ORDER BY commentaires.datecommentaire 
                                            DESC limit 0, 3");
$req2->bindValue(':idnews', $news["id_news"]);

$req2->execute();
?>