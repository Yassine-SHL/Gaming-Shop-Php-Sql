<?php
session_start();
require_once 'fonctions.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    header {
        background-color: #f8f9fa;
        text-align: center;
        display: flex;
        align-items: center;
        gap: 15px;
        background-color:darkslategrey;
        height:fit-content;
    }
    #logo {
        max-width: 80px;
        height: 80px;
        padding: 5px;
    }
    h1{
        color:goldenrod;
    }
    nav{
        display: flex;
        gap: 15px;
        margin-left: 90px;
        font-weight: bolder;
    }

    nav i {
        margin-right: 5px;
    }
    body{
        background-image: url('images/back.jpg');
    }
    .table-primary{
        margin-left: 150px;
    }
    .nom{
        width: 70px;
        color: black;
    }
    .form-container {
            max-width: 700px;
            margin: auto;
        }
</style>
<body>
    <header>
        <a href="index.php">
            <img src="images/gaming.pnj" id="logo" alt="" width="100px" >
        </a>
        <h1>Gaming Shop</h1>
        <?php if (isset($_SESSION["connexion"])): ?>
            <?php if ($_SESSION["connexion"] == "client"): ?>
                <table class="table-primary">
                    <tr class="table-primary">
                        <td class="table-primary nom">BONJOUR</td>
                        <td class="table-primary nom"><?= $_SESSION["nom"] ?></td>
                    </tr>
                </table>
                <nav>
                    <a href="visualiserCompte.php"><i class="bi bi-person-circle"></i>Mon Profil</a>
                    <a href="panier.php"><i class="bi bi-cart2"></i>Mon Panier</a>
                    <a href="commandes.php"><i class="bi bi-cart2"></i>Mes Commandes</a>
                    <a href="deconnexion.php"><i class="bi bi-arrow-bar-left"></i>Me Déconnecter</a>
                </nav>
            <?php elseif ($_SESSION["connexion"] == "pasClient"): ?>
                <nav style="margin-left: auto; margin-right: auto;">
                    <a href="inscription.php"><i class="bi bi-house-door"></i>M'inscrire</a>
                    <a href="connexion.php"><i class="bi bi-arrow-bar-right"></i>Me connecter</a>
                    <a href="panier.php"><i class="bi bi-cart2"></i>Mon Panier</a>
                </nav>
            <?php elseif ($_SESSION["connexion"] == "admin"): ?>
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <a class="nav-link active" aria-current="page" href="index.php">Page d'accueil</a>
                    <a class="nav-link" href="utilisateurs.php"><i class="bi bi-person-lines-fill"> Voir Utilisateurs</i></a>
                    <a class="nav-link" href="produit.php"><i class="bi bi-pencil-square">Mes Produits</i></a>
                    <a class="nav-link" href="commandesAdmin.php"><i class="bi bi-pencil-square">Commandes</i></a>
                    <a class="nav-link" href="deconnexion.php"><i class="bi bi-arrow-bar-left"></i>Me Déconnecter</a>
                </nav>
            <?php endif; ?>
        <?php endif; ?>
    </header>
</body>