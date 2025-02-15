<?php
include 'headerIndex.php';
$produits=afficherProduits();
if(isset($_POST['btn-rechercher'])){
    $filtre=$produits;
    $filtre=rechercherProduits($_POST['category_name']);
    $livres=[];
    if(count($filtre)>0){
        $produits=$filtre;
    }
}
if(isset($_POST['btn-reset'])){
  $produits=afficherProduits();
}
?>
<style>
    .image {
      height: 180px;
      width:235px;
      border-radius: 15px;
        
    }
    .container {
      position: relative; 
      padding: 10px;
    }

    .fixed-bottom {
      position:absolute;
      bottom: 0;
      width: 90%;
      padding-left: 10px;
      padding-bottom: 5px;
    }
    .card{
      padding: 10px;
      background-color:goldenrod ;
      border-radius: 15px;
    }
    .card-body{
      max-height: 230px;
    }
</style>
<div class="container-fluid" style="width: 400px; margin-top:20px">
<form method="POST" class="container form-container" style="margin-top: 33px;">
        <label for="category_name" class="form-label">Filtrer par Catégorie</label>
        <select name="category_name" id="category_name">
            <option>Consoles</option>
            <option>Jeux vidéos</option>
            <option>Accessoires de Jeux</option>
            <option>Ordinateurs</option>
            <option>Setup</option>
            <option>Autre</option>
        </select>
        <button class="btn btn-outline-success" name="btn-rechercher" type="submit">Search</button>
        <button class="btn btn-outline-success" name="btn-reset" type="submit">Reset</button>
  </form>
  </div>
<div class="container mt-4">
    <div class="row">
    <?php foreach($produits as $produit ){   ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                <a href="visualiserProduit.php?id=<?= $produit['id_produit']; ?>">
                    <img src='<?php
                        if(isset($produit['chemin']) && !empty($produit['chemin'])){
                          echo $produit['chemin'];
                        }
                        else{
                          echo 'images/defaultImage.jpg';
                        }
                        
                        ?>' class="image" alt=""></a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $produit['nom']; ?></h5>
                        <p class="card-text"><?= $produit['courte_description']; ?></p>
                        <div class="d-flex justify-content-between align-items-center fixed-bottom">
                            <a href="ajouterPanier.php?id=<?= $produit['id_produit']; ?>" class="btn btn-success"><i class="bi bi-cart"></i>&nbsp;&nbsp;Panier</a>
                            <span class="text-primary font-weight-bold"><?= $produit['prix_unitaire']; ?> $</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
    </div>
</div>

</body>
</html>