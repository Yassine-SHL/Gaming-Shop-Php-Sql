<?php 
include 'headerIndex.php';
$email=$_SESSION['email'];
$utilisateur=getUtilisateurByEmail2($email);
if(isset($_POST['btn-modifier'])){
    modifierUtilisateur($_POST,$email);
    header('Location:index.php');
}
?>

<body>
<style>
    label{
        color: #1D93E2;
        font-weight: bolder;
    }
</style>
<body>
<form method="POST" class="container form-container" style="margin-top: 33px;">
    <div class="mb-1">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?= $utilisateur["nom"] ?>" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $utilisateur["prenom"] ?>" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="courriel" class="form-label">courriel</label>
        <input type="email" class="form-control" name="courriel" id="courriel" value="<?= $utilisateur["email"] ?>" aria-describedby="emailHelp">
    </div>
        <label for="dateNais" class="form-label">Date de naissance</label>
        <input type="date" class="form-control" name="dateNais" id="dateNais" value="<?= $utilisateur["dateNais"] ?>">
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="telephone" id="telephone" value="<?= $utilisateur["telephone"] ?>">
    </div>
    <input type="submit" class="btn btn-primary" name="btn-modifier" value="modifier Informations" >
</form>
</body>
</body>
</html>