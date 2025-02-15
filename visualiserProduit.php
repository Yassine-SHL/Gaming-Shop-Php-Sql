<?php
include 'headerIndex.php';
$id_produit=$_GET['id'];
$produit=visualiserProduit($id_produit);



?>




<style>
    .card{
        margin: auto;
        margin-top: 150px;
        background-color: whitesmoke;
        border-radius: 10px;
    }
    img{
      border-radius: 10px;
      padding: 3px;
    }
</style>


<body>
<div class="card mb-3" style="max-width: 800px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img width="100%" height="100%" src="<?= $produit['chemin']; ?>" class="img-fluid rounded-start">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title" style="font-weight: bolder;"><?= $produit['nom']; ?></h5>
        <p class="card-text" style="margin-top: 50px;"><?= $produit['description']; ?></p>
        <p class="card-text" style="color: green; margin-top:50px;"><?= $produit['prix_unitaire']; ?> $</p>
        <a href="ajouterPanier.php?id=<?= $id_produit ?>" class="btn btn-success"><i class="bi bi-cart"></i>&nbsp;&nbsp;Panier</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>