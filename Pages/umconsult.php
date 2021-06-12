<?php
@session_start();

//Header avec class BS
include_once("./Commons/header.php");
include("Commons/connexionBdd.php");?>

<title>Consulter les données des UM</title>

<!-- Contenu du site-->
<div class="border m-2 p-2 ">

    <h1 class="text-center align-middle text-black">Consulter profil UM</h1>

    <?php
    //preparation de la requete de recherche dans la base de donnée des produits
    $req=$bdd->prepare("SELECT * FROM users");

    //execute la requete avec le login saisi par l'utilisateur
    $req->execute();?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Login</th>
            <th scope="col">Email</th>
            <th scope="col">Adresse</th>
            <th scope="col">Code Postal</th>
            <th scope="col">Commune</th>
            <th scope="col">Date de naissance</th>
            <th scope="col"></th>
        </tr>
        <tbody>
    <?php
    while($user=$req->fetch()) {
        $i=0;?>
            <tr>
                <th scope="row"><?php echo $user['id_user']?></th>
                <td><?php echo $user['nom']?></td>
                <td><?php echo $user['prenom']?></td>
                <td><?php echo $user['login']?></td>
                <td><?php echo $user['email']?></td>
                <td><?php echo $user['adresse']?></td>
                <td><?php echo $user['cp']?></td>
                <td><?php echo $user['commune']?></td>
                <td><?php echo $user['datenaissance']?></td>
                <td><a href="editprofil.php?id=<?php echo $user['id_user']?>"> Edit</a></td>
            </tr>
    <?php $i++;
    }
    ?>
        </tbody>
    </table>

</div>

<!-- Pied de page-->
<?php include_once("./Commons/footer.php"); ?>





