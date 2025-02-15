<?php
include 'headerIndex.php';
$id_utilisateur=$_GET['id'];
supprimerUtilisateur($id_utilisateur);
var_dump(supprimerUtilisateur($id_utilisateur));

?>
<script>
    window.location.href='utilisateurs.php';
</script>