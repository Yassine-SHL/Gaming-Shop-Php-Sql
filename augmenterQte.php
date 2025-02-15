<?php
include 'headerIndex.php';
$id_produit=$_GET['id'];
$_SESSION['panier'][$id_produit]++;
?>
<script>
    window.location.href='panier.php';
</script>