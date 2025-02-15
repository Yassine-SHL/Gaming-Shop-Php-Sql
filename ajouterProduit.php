<?php
include 'headerIndex.php';
if(isset($_POST['btn-ajout'])){
    $res=ajoutProduit($_POST);
    if($res){
        $res_upload=uploadIamge($_FILES,'image');
        if($res_upload){
            $resultat=ajouterImage($res,$res_upload);
            if($resultat){
                ?>
                <script>
                    window.location.href="produit.php";
                </script>
                <?php
            }
        }
    }
    else{
        echo 'Ajout invalide';
    }
}

?>
<style>
    body{
        color:aqua;
        font-weight: bolder;
    }
</style>
<body>
<form method="POST"  enctype="multipart/form-data" class="container form-container" style="margin-top: 33px;">
    <div class="mb-1">
        <label for="nomProduit" class="form-label">Nom du produit</label>
        <input type="text" class="form-control" name="nomProduit" id="nomProduit" required>
    </div>
    <div class="mb-3">
        <label for="prixUnitaire" class="form-label">Prix unitaire</label>
        <input type="text" class="form-control" name="prixUnitaire" id="prixUnitaire" required>
    </div>
    <div class="mb-3">
        <label for="courteDescription" class="form-label">Courte description</label>
        <textarea class="form-control" name="courteDescription" id="courteDescription" placeholder="Votre courte description ici" required></textarea>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" placeholder="Votre description ici" required></textarea>
    </div>
    <div class="mb-3">
        <label for="quantite" class="form-label">Quantité</label>
        <input type="text" class="form-control" name="quantite" id="quantite" required>
    </div>
    <div class="mb-3">
        <label for="categorie" class="form-label">Catégorie</label>
        <select name="categorie" id="categorie">
            <option>Consoles</option>
            <option>Jeux vidéos</option>
            <option>Accessoires de Jeux</option>
            <option>Ordinateurs</option>
            <option>Setup</option>
            <option>Autre</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image du produit</label>
        <input type="file" class="form-control" name="image" id="image">
    </div>
    <input type="submit" class="btn btn-primary" name="btn-ajout" value="Ajouter" style="margin-left: 590px;">
</form>
</body>
</html>