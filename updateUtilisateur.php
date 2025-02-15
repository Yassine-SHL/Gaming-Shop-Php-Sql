<?php
include 'fonctions.php';
$id_utilisateur=$_GET['id'];
updateRole($id_utilisateur);
header('Location: utilisateurs.php');

?>