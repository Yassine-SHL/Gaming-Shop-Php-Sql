<?php
include 'headerIndex.php';
$utilisateurs=getUtilisateurs();
?>
<style>
    thead{
        color: #1D93E2;
        font-weight:bolder;
    }
    tbody{
        color: whitesmoke;
        font-weight: bold;
    }
    .alert{
        margin-top: 60px;
        text-align: center;
    }
    td{
        width: fit-content;
    }
</style>
<body >
  <div class="container mt-5">
<table class="table table-bordered border-primary">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Courriel</th>
      <th scope="col">Date de naissance</th>
      <th scope="col">Téléphone</th>
      <th scope="col">Rôle</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
  <?php $i=1; foreach($utilisateurs as $utilisateur){ ?>
    <tr>
      <th scope="row"><?= $i++ ?></th>
      <td><?= $utilisateur['nom'] ?></td>
      <td><?= $utilisateur['prenom'] ?></td>
      <td><?= $utilisateur['courriel'] ?></td>
      <td><?= $utilisateur['date_de_naissance'] ?></td>
      <td><?= $utilisateur['telephone'] ?></td>
      <?php if($utilisateur['description']=="admin"){ ?>
      <td style="color: goldenrod; font-weight:gold"><?= $utilisateur['description'] ?>&nbsp;&nbsp;<a href="updateUtilisateur.php?id=<?= $utilisateur['id_utilisateur']; ?>" class="btn btn-light"><i class="bi bi-patch-check-fill"></i>&nbsp;&nbsp;Changer Statut</i></a></td>
      <?php } 
      else{ ?>
        <td><?= $utilisateur['description'] ?>&nbsp;&nbsp;<a href="updateUtilisateur.php?id=<?= $utilisateur['id_utilisateur']; ?>" class="btn btn-light"><i class="bi bi-patch-check-fill"></i>&nbsp;&nbsp;Changer Statut</i></a></td>
      <?php }?>
      <td>
        <a class="btn btn-danger" href="supprimerUtilisateur.php?id=<?= $utilisateur['id_utilisateur']; ?>"><i class="bi bi-trash3-fill"></i></a>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
  </div>
</body>
</html>