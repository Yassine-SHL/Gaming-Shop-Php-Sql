<?php
include 'fonctions.php';
if(isset($_POST['btn-inscrire'])){
    $res=inscription($_POST);
    ?>
    <script>
        window.location.href="connexion.php";
    </script>
    <?php
    /*if($res){
        echo 'oui';
    }
    else{
        echo 'non';
    }*/
}
include 'headerIndex.php';
//var_dump($_POST);
?>
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
        <input type="text" class="form-control" name="nom" id="nom" required>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom" id="prenom" required>
    </div>
    <div class="mb-3">
        <label for="courriel" class="form-label">courriel</label>
        <input type="email" class="form-control" name="courriel" id="courriel" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
        <label for="motdepasse" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="motdepasse" id="motdepasse" required>
    </div>
    <div class="mb-3">
        <label for="motdepasseConf" class="form-label">Confirmer le mot de passe</label>
        <input type="password" class="form-control" name="motdepasseConf" id="motdepasseConf" required>
    </div>
    <div class="mb-3">
        <label for="dateNais" class="form-label">Date de naissance</label>
        <input type="date" class="form-control" name="dateNais" id="dateNais">
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="telephone" id="telephone" required>
    </div>
    <div class="mb-3">
        <label for="sexe" class="form-label">Sexe</label><br>
        <select name="categorie" id="categorie" class="form-control">
            <option>Je préfère ne pas divulger</option>
            <option>Homme</option>
            <option>Femme</option>
        </select>
    </div>
    <input type="submit" class="btn btn-primary" name="btn-inscrire" value="S'inscrire" >
</form>
</body>
</html>