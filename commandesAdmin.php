<?php
include 'headerIndex.php';
$commandes=getAllCommandes();

?>
<body>
<table class="table table-dark table-striped-columns">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom Client</th>
      <th scope="col">Quantité</th>
      <th scope="col">Date de Commande</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($commandes as $commande){ ?>
    <tr>
      <th scope="row"><?= $i++; ?></th>
      <td><?= $commande['nom']; ?></td>
      <td><?= $commande['quantite']; ?></td>
      <td><?= $commande['date_commande']; ?></td>
      <td><a class="btn btn-primary" href="detailsCommande.php?id=<?= $commande['id_commande']; ?>"><i class="bi bi-list">Détails</i></a></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</body>
</html>