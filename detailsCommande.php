<?php
include 'headerIndex.php';
$id_commande=$_GET['id'];
$details=getcommandedétails($id_commande);
$infosCommande=$details[0];
?>
<style>
    body{
        color:darkolivegreen;
        font-weight: bold;
    }
    tr{
        height: 50px;
    }
</style>
<body>
    <h1 style="text-align:center; color:cornflowerblue; margin-top:15px;">Détails de la commande</h1>
    <div style="color:darkorange; font-weight:bolder;">
    <h5>Commande Num: <?= $infosCommande['id_commande']; ?></h5>
    <p>Quantité Totale : <?= $infosCommande['total_quantite']; ?></p>
    <p>Date de création : <?= $infosCommande['date_commande']; ?></p>
    <p>Utilisateur : <?= $infosCommande['nom'].' '.$infosCommande['prenom']; ?></p>
    <p>Courriel : <?= $infosCommande['courriel']; ?></p>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <td>Titre</td>
                <td>Quantité</td>
                <td>Prix Unitaire</td>
                <td>Prix Total</td>
            </tr>
        </thead>
        <tbody>
        <?php $totalPrixProduit=0; $total=0; foreach($details as $commande){ ?>
            <tr>
                <td><?= $commande['nom_produit']; ?></td>
                <td><?= $commande['quantite']; ?></td>
                <td><?= $commande['prix_unitaire']; ?> $</td>
                <?php $totalPrixProduit=$commande['prix_unitaire']*$commande['quantite']; ?>
                <td><?= $totalPrixProduit; ?> $</td>
                <?php $total+=$totalPrixProduit; ?>
            </tr>
            <?php } ?>
            <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td><span style="font-weight: bolder; text-decoration:underline;"><?= $total; ?> $</span></td>
            </tr>
        </tbody>
    </table>
    
</body>
</html>