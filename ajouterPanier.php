
<?php
include 'headerIndex.php';

if (!isset($_SESSION['panier'] )) {
    $_SESSION['panier']=[];
}
$id_produit=$_GET['id'];
ajouterAuPanier($id_produit,1);
var_dump($_SESSION['panier']);
/*var_dump($_SESSION['panier']);*/

?>
<script>
    
    window.location.href ="panier.php?id=<?= $id_produit;?>";

</script>

