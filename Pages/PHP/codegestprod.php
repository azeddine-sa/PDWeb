<?php
@$type = $_POST['type'];
@$nom = $_POST['nom'];
@$desc = $_POST['desc'];
@$pu = $_POST['pu'];
@$stock = $_POST['stock'];
@$dispo = $_POST['dispo'];
@$message = "";
@$valider = $_POST['valider'];
@$supprimer = $_POST['supprimer'];


if(isset($valider)){
    if(empty($type)) $message="<li>Choisir un type de produit!</li>";
    if(empty($nom)) $message="<li>Inserer un nom !</li>";
    if(empty($desc)) $message="<li>Inserer une description!</li>";
    if(empty($pu)) $message="<li>Inserer un prix unitaire!</li>";
    if(empty($stock)) $message="<li>Inserer une quantité dans le stock!</li>";
    if(empty($dispo)) $message="<li>Veuillez indiquer si le stock est dispo!</li>";

    if(empty($message)){
        if(empty($_FILES['img'])){
            move_uploaded_file($_FILES['img']['tmp_name'], './SRC/img/produits/informatiques/');
            $addimg = "../SRC/img/produits/informatiques/".$_FILES['img']['name'];
            $req = $bdd->prepare('INSERT INTO produits(categorie_id,nom,description,prixunitaire,stock,disponible,img) VALUES(?,?,?,?,?,?,?)');
            $req->execute(array($type,$nom,$desc,$pu,$stock,$dispo,$addimg));
            $message="Le produit ".$nom." a bien été ajouté!";
            $_FILES['img']="";
        }else{
            $req2 = $bdd->prepare('INSERT INTO produits(categorie_id,nom,description,prixunitaire,stock,disponible,img) VALUES(?,?,?,?,?,?,NULL)');
            $req2->execute(array($type,$nom,$desc,$pu,$stock,$dispo));
            $message="Le produit ".$nom." a bien été ajouté!";
        }
    }else{
        echo $message;
    }
}

if(isset($supprimer)){
    $prodToDel = $_POST['prod_select'];
    $del = $bdd->prepare('DELETE FROM produits WHERE id_produit=?');
    $del->execute(array($prodToDel));
    $message = "Le produit a bien été supprimé";
}
?>
