<?php

include 'headerIndex.php';
$error='';
$_SESSION["connexion"]="pasClient";
if(isset($_POST['btn-conn'])){
    $res=getUtilisateurByEmail($_POST);
    unset($_SESSION['panier']);
    if($res["res"]){
        $_SESSION["id"]=$res["id"];
        $_SESSION["nom"]=$res["nom"];
        
        $_SESSION["email"]=$_POST['email'];
        $id_role=getrolebyId($res["id"]);
        if($id_role==1){
            $_SESSION["connexion"]="client";
            ?>
        <script>
            window.location.href='index.php';
        </script>
        <?php
        }
        if($id_role==2){
            $_SESSION["connexion"]="admin";
            ?>
        <script>
            window.location.href='pageAdmin.php';
        </script>
        <?php
        }
        
    }
    else{
        $error= '<div class="mb-3 msgErreur">
    <p>E-mail ou mot de passe incorrect</p>
  </div>';
    }
    }

?>
    



<style>
    body{
        background-image: url('images/cnxback.png');
        background-size: cover;
    }
    .form-label{
        color:aqua;
        font-weight: bolder;
    }
    .container{
        border: 5px dashed purple;
        border-radius: 10px;
        margin-top: 180px;
        padding: 30px;
        background-color:transparent;
        width: 700px;
    }
    .btn{
        background-color: purple;

    }
    button:hover{
        background-color: blue;
    }
    a{
        margin-left: 50px;
        color:aqua;
        font-weight: bolder;
    }
    .msgErreur{
        color:red;

    }
</style>


<body>
<div class="container form-container">
<form method="POST" class="container2 form-container" style="margin-top: 33px;">
  <div class="mb-3">
    <label for="email" class="form-label">Courriel</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label for="mdp" class="form-label">Password</label>
    <input type="password" class="form-control" id="mdp" name="mdp" required>
  </div>
  <button type="submit" name="btn-conn" class="btn btn-primary">Connexion</button>
  <a href="inscription.php">S'inscrire?</a>
  <?= $error; ?>
</form>
</div>
</body>
</html>