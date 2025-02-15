<?php
include 'headerIndex.php';
$produits=afficherProduits();
?>
<style>
    thead{
        color: #1D93E2;
        font-weight:bolder;
    }
    tbody{
        color: #A85EEA;
        font-weight: bold;
    }
    .alert{
        margin-top: 60px;
        text-align: center;
    }
    .image img{
      width: 110px;
      height: 110px;
    }
</style>
<body >
  <div class="container mt-5">
<table class="table table-bordered border-primary">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Nom</th>
      <th scope="col">Prix</th>
      <th scope="col">Quantité</th>
      <th scope="col">Catégorie</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php $i=1; foreach($produits as $produit){ ?>
    <tr>
      <th scope="row"><?= $i++ ?></th>
      <td class="image"><img src='<?php
      if(isset($produit['chemin']) && !empty($produit['chemin'])){
        echo $produit['chemin'];
      }
      else{
        echo 'images/defaultImage.jpg';
      }
      
      ?>' ></td>
      <td><?= $produit['nom'] ?></td>
      <td><?= $produit['prix_unitaire'] ?></td>
      <td><?= $produit['quantite'] ?></td>
      <td><?= $produit['categorie'] ?></td>
      <td>
        <a class="btn btn-info" href="visualiserProduit.php?id=<?= $produit['id_produit']; ?>"><i class="bi bi-eye-fill"></i></a>
        <a class="btn btn-primary" href="modifierProduit.php?id=<?= $produit['id_produit']; ?>"><i class="bi bi-pencil-fill"></i></a>
        <a class="btn btn-danger" href="supprimerProduit.php?id=<?= $produit['id_produit']; ?>"><i class="bi bi-trash3-fill"></i></a>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
<a class="btn btn-primary" href="ajouterProduit.php">Ajouter un produit</a>
  </div>
</body>
</html>