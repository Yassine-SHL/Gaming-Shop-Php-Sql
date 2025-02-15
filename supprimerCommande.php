<?php
include 'headerIndex.php';
$id_commande= $_GET['id'];
supprimerCommande($id_commande);
?>
<script>
    window.location.href='commandes.php';
</script>