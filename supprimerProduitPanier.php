<?php
include 'headerIndex.php';
$id_produit=$_GET['id'];
unset($_SESSION['panier'][$id_produit]);



?>
<script>
    window.location.href='panier.php';
</script>