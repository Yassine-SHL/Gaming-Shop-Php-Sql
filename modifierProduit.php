<?php
include 'headerIndex.php';
$id_produit=$_GET['id'];
$produit=getProduitById($id_produit);
//var_dump($produit);
if(isset($_POST['btn-modifier'])){
    $_POST['id_produit']=$id_produit;
    updateProduit($_POST);
    header('Location: produit.php');
}




?>


<body>
<form method="POST"  enctype="multipart/form-data" class="container form-container" style="margin-top: 33px;">
    <div class="mb-1">
        <label for="new_nomProduit" class="form-label">Nouveau nom du produit</label>
        <input type="text" value="<?=$produit['nom']; ?>" class="form-control" name="new_nomProduit" id="new_nomProduit">
    </div>
    <div class="mb-3">
        <label for="new_prixUnitaire" class="form-label">Nouveau prix unitaire</label>
        <input type="text" value="<?=$produit['prix_unitaire']; ?>" class="form-control" name="new_prixUnitaire" id="new_prixUnitaire">
    </div>
    <div class="mb-3">
        <label for="new_courteDescription" class="form-label">Nouvelle courte description</label>
        <textarea class="form-control" name="new_courteDescription" id="new_courteDescription" placeholder="Votre courte description ici"><?=$produit['courte_description']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="new_description" class="form-label">Nouvelle description</label>
        <textarea class="form-control" name="new_description" id="new_description" placeholder="Votre description ici"><?=$produit['description']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="new_quantite" class="form-label">Nouvelle quantité</label>
        <input type="text" value="<?=$produit['quantite']; ?>" class="form-control" name="new_quantite" id="new_quantite">
    </div>
    <div class="mb-3">
        <label for="new_categorie" class="form-label">Nouvelle catégorie</label>
        <select name="new_categorie" id="new_categorie">
            <option><?=$produit['categorie']; ?></option>
            <option>Consoles</option>
            <option>Jeux vidéos</option>
            <option>Accessoires de Jeux</option>
            <option>Ordinateurs</option>
            <option>Setup</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="new_image" class="form-label">Nouvelle image du produit</label>
        <input type="file" class="form-control" name="new_image" id="new_image">
    </div>
    <input type="submit" class="btn btn-primary" name="btn-modifier" value="Confirmer modification" style="margin-left: 590px;">
</form>
</body>