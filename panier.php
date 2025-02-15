<?php
include 'headerIndex.php';
$produits = getPanier();
?>
<style>
.image img {
  max-width: 100px;
  max-height: 100px;
  object-fit: cover; 
}
thead {
  color: brown;
}
tbody {
  color: whitesmoke;
}
td a {
  margin-left: 15px;
  margin-right: 15px;
}
.tab{
  border-radius: 10px;
  width: 350px;
}
</style>

<body>
<div class="container mt-5">
<form method="post">
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
  <?php $i = 1; $total = 0; $quantite = 0; foreach ($produits as $produit) { ?>
    <tr>
      <th scope="row"><?= $i++ ?></th>
      <td class="image"><img src='<?php
      if (isset($produit['chemin']) && !empty($produit['chemin'])) {
        echo $produit['chemin'];
      } else {
        echo 'images/defaultImage.jpg';
      }
      ?>' ></td>
      <td><?= $produit['nom'] ?></td>
      <td><?= $produit['prix_unitaire'] ?></td>
      <td>
        <?php if ($produit['quantite'] > 0) { ?>
        <a href="DiminuerQte.php?id=<?= $produit['id_produit']; ?>" class="btn btn-light"><i class="bi bi-dash-square-fill"></i></a>
        <?php } ?>
        <?= $produit['quantite'] ?>
        <?php if ($produit['quantite'] < getProduitById($produit['id_produit'])['quantite']) { ?>
        <a href="augmenterQte.php?id=<?= $produit['id_produit']; ?>" class="btn btn-light"><i class="bi bi-plus-square-fill"></i></a>
        <?php } ?>
      </td>
      <td><?= $produit['categorie'] ?></td>
      <td>
        <a class="btn btn-info" href="visualiserProduit.php?id=<?= $produit['id_produit']; ?>"><i class="bi bi-eye-fill"></i></a>
        <a class="btn btn-danger" href="supprimerProduitPanier.php?id=<?= $produit['id_produit']; ?>"><i class="bi bi-trash3-fill"></i></a>
      </td>
    </tr>
    <?php
    $total += $produit['prix_unitaire'] * $produit['quantite'];
    $quantite += $produit['quantite'];
   } ?>
  </tbody>
  <?php if($quantite>0 && $_SESSION['connexion']!='pasClient'){?>
</table>
<table class="tab table-success">
  <tr>
    <td style="justify-content: center; font-weight:bolder; text-decoration:underline; color:brown; font-size:25px">Facture</td>
  </tr>
  
  <tr>
    <td><p class="font-monospace" style="font-weight: bold; color:cadetblue;">Quantité : <?= $quantite ?> Pcs</p></td>
  </tr>
  <tr>
    <td><p class="font-monospace" style="font-weight: bold; color:cadetblue;">Sous Total : <?= $total ?>$</p></td>
  </tr>
  <tr>
    <td><p class="font-monospace" style="font-weight: bold; color:cadetblue;">Montant TPS : <?php $tps=$total*5/100; echo round($tps,2); ?>$</p></td>
  </tr>
  <tr>
    <td><p class="font-monospace" style="font-weight: bold; color:cadetblue;">Montant TVQ : <?php $tvq=$total*9.975/100; echo round($tvq,2); ?>$</p></td>
  </tr>
  <tr>
    <td>
    <p class="font-monospace" style="font-weight: bolder; text-decoration: underline; color: darkgreen;">Total à payer : <?php $mttc=$total+$tps+$tvq; echo round($mttc,2); ?>$ <?php if ($total > 0) { 
      $_SESSION['mttc']=$mttc;
      include 'payement.php';?>
   <input type="submit" class="btn btn-info" name="btn-commander" value="Commander" style="margin-left: 110px;">
   <?php } ?></p>
    </td>
  </tr>
</table>
<?php } 
if($_SESSION['connexion']=='pasClient'){
  echo '<div class="alert alert-info" role="alert">
                Pour Effectuer une commande , vous devez avoir un compte sur notre site. <a href="inscription.php">pour créer un compte</a>
                <a href="connexion.php">pour se connecter</a>
            </div>';
}?>
<a class="btn btn-primary" href="index.php">Retour</a>
</form>
</div>
</body>
</html>
<?php
if($quantite>0){
if (isset($_POST['btn-commander'])) {
  $id_commande = ajouterCommande($_SESSION['id'], $quantite, $total);
  foreach($produits as $produit){
    insertCommandeProduit($id_commande,$produit['id_produit'],$produit['quantite']);
  }
      ?>
      <script>
          window.location.href = 'commandes.php';
      </script>
      <?php
}
}
?>
