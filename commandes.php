<?php
include 'headerIndex.php';
$commandes=getCommandesById($_SESSION['id']);

?>
<style>
    body{
        color: white;
    }
</style>
<body>
    <?php if(count($commandes)>0){?>
<table class="table table-dark table-striped-columns">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Quantité</th>
      <th scope="col">Prix</th>
      <th scope="col">Date de Commande</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($commandes as $commande){ ?>
    <tr>
      <th scope="row"><?= $i++; ?></th>
      <td><?= $commande['quantite']; ?></td>
      <td><?= $commande['prix']; ?>$</td>
      <td><?= $commande['date_commande']; ?></td>
      <td><a class="btn btn-danger" href="supprimerCommande.php?id=<?= $commande['id_commande']; ?>"><i class="bi bi-dash-circle-fill"></i></a></td>
      <td><a class="btn btn-warning" href=""><i class="bi bi-check2-circle"></i>Payée</a></td>
    </tr>
    <?php } }?>
  </tbody>
</table>
</body>
</html>