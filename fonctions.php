<?php

//pour afficher l erreur si il y en a
error_reporting(E_ALL);
ini_set('display_errors',1);

include './config.php';

/**
 * fonction qui permet le connection a la base de données
 * @return mysqli | false
 */
function connexionDB(){
    $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT);
    if($conn){
        return $conn;
    }
    else{
        return "Erreur de connexion a la base de donnée ". mysqli_connect_error();
    }
}
/**
 * function qui permet inscription d'un nouvel utilisateur
 *
 * @param array $data
 * @return bool
 */
function inscription($data){
    $nom=$data['nom'];
    $prenom=$data['prenom'];
    $courriel=$data['courriel'];
    $motdepasse=$data['motdepasse'];
    $motdepasseConf=$data['motdepasseConf'];
    $dateNais=$data['dateNais'];
    $telephone=$data['telephone'];
    $sexe=$data['sexe'];
    $conn=connexionDB();
    if($motdepasse===$motdepasseConf){
        $sql='insert into utilisateur (nom,prenom,courriel,motdepasse,date_de_naissance,telephone,sexe) values(?,?,?,?,?,?,?)';
        $motdepasse=password_hash($motdepasse,PASSWORD_DEFAULT);
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'sssssss',$nom,$prenom,$courriel,$motdepasse,$dateNais,$telephone,$sexe);
        $res= mysqli_stmt_execute($stmt);
        if($res){
            //prend le dernier id
            $id_utilisateur=mysqli_insert_id($conn);
            insertRoleUtilisateur(1,$id_utilisateur);
        }
        else{
            return false;
        }
        }
    else{
        ?>
        <script>
            alert('le mot de passe confirmé est invalide');
        </script>
        <?php
    }
}
/**
 * fonction qui permet d assigner un role a chaque utilisateur
 *
 * @param int $id_role
 * @param int $id_utilisateur
 * @return bool
 */
function insertRoleUtilisateur($id_role,$id_utilisateur){
    $conn=connexionDB();
    $sql='insert into role_utilisateur values(?,?)';
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'ii',$id_role,$id_utilisateur);
    return mysqli_stmt_execute($stmt);
}
/**
 * fonction qui permet de recuperer l id du role en fonction de l id de l utilisateur
 *
 * @param int $id_utilisateur
 * @return int
 */
function getrolebyId($id_utilisateur){
    $conn=connexionDB();
    $sql='select id_role from role_utilisateur where id_utilisateur=?';
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_utilisateur);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_role);
    mysqli_stmt_fetch($stmt);
    return $id_role;
}
/**
 * fonction qui permet d'ajouter un produit et retourne son id
 *
 * @param array $data
 * @return int | false
 */
function ajoutProduit($data){
    $nomProduit=$data['nomProduit'];
    $prixUnitaire=$data['prixUnitaire'];
    $courteDescription=$data['courteDescription'];
    $description=$data['description'];
    $quantite=$data['quantite'];
    $categorie=$data['categorie'];
    $conn=connexionDB();
    $sql='insert into produit(nom,description,courte_description,prix_unitaire,quantite,categorie) values(?,?,?,?,?,?)';
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'ssssis',$nomProduit,$description,$courteDescription,$prixUnitaire,$quantite,$categorie);
    $res= mysqli_stmt_execute($stmt);
    if($res){
        $id_produit=mysqli_insert_id($conn);
        return $id_produit;
    }
    return false;
}
function afficherProduits(){
    $conn=connexionDB();
    $sql='select p.*,i.chemin from produit p left join image i on p.id_produit=i.id_produit';
    $resultat=mysqli_query($conn,$sql);
    $produits=[];
    if(mysqli_num_rows($resultat)>0){
        foreach($resultat as $produit){
            $produits[]=$produit;
        }
        return $produits;
    }
    else{
        echo '<div class="alert alert-info" role="alert">
                Aucun produit est ajouté
            </div>';
    }
}
/**
 * fonction qui upload mon image et me retourne le chemin dans mon serveur
 *
 * @param array $file
 * @param string $cle
 * @return string | false
 */
function uploadIamge($file,$cle="image"){
    if(isset($_FILES[$cle]) && $_FILES[$cle]['error']==UPLOAD_ERR_OK){
        $from=$_FILES[$cle]['tmp_name'];
        $name_image=$_FILES[$cle]['name'];
        $to="images/".basename($name_image);
        $extension=strtolower(pathinfo($to,PATHINFO_EXTENSION));
        $extensions=['jpg','jpeg','gif','png'];
        if(in_array($extension,$extensions)){
            move_uploaded_file($from,$to);
            return $to;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}
/**
 * fonction qui permet d'insérer une image dans la base de donnee
 *
 * @param int $id_produit
 * @param string $chemin
 * @return bool
 */
function ajouterImage($id_produit,$chemin){
    $sql='insert into image(id_produit,chemin) values(?,?)';
    $conn=connexionDB();
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'is',$id_produit,$chemin);
    return mysqli_stmt_execute($stmt);
}
function getProduitById($id_produit){
    $sql='select p.*,i.chemin from produit p left join image i on p.id_produit=i.id_produit where p.id_produit=?';
    $conn=connexionDB();
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_produit);
    $res=mysqli_stmt_execute($stmt);
    if($res){
        $res=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res)>0){
            $produit=mysqli_fetch_assoc($res);
            return $produit;
        }
        return false;
    }
    return false;
}
/**
 * fonction qui supprime un produit en fonction de son id
 *
 * @param int $id_produit
 * @return bool
 */
function supprimerProduit($id_produit){
    $sql='delete from produit where id_produit=?';
    $conn=connexionDB();
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_produit);
    return mysqli_stmt_execute($stmt);
}
/**
 * fonction qui permet de mettre a jour un produit
 *
 * @param array $data
 * @return bool
 */
function updateProduit($data){
    $new_nomProduit=$data['new_nomProduit'];
    $new_prixUnitaire=$data['new_prixUnitaire'];
    $new_courteDescription=$data['new_courteDescription'];
    $new_description=$data['new_description'];
    $new_quantite=$data['new_quantite'];
    $new_categorie=$data['new_categorie'];
    $id_produit=$data['id_produit'];
    $conn=connexionDB();
    $sql='update produit set nom=? , description=? , courte_description=? , prix_unitaire=? , quantite=? , categorie=? where id_produit=?';
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'ssssisi',$new_nomProduit,$new_description,$new_courteDescription,$new_prixUnitaire,$new_quantite,$new_categorie,$id_produit);
    return mysqli_stmt_execute($stmt);
}
/**
 * fonction qui permet de voir un produit
 *
 * @param int $id_produit
 * @return array | false
 */
function visualiserProduit($id_produit){
    $sql='select nom,courte_description,prix_unitaire,chemin,description from produit right join image on image.id_produit=produit.id_produit where produit.id_produit=?';
    $conn=connexionDB();
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_produit);
    $res=mysqli_stmt_execute($stmt);
    if($res){
        $res=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res)>0){
            $produit=mysqli_fetch_assoc($res);
            return $produit;
        }
        return false;
    }
    return false;
}
/**
 * fonction qui permet la connexion d'un utilisateur
 *
 * @param array $data
 * @return bool
 */
function getUtilisateurByEmail($data){
    $email=$data['email'];
    $mdp=$data['mdp'];
    $conn=connexionDB();
    $sql='select courriel,motdepasse,id_utilisateur,nom,prenom,date_de_naissance,telephone from utilisateur where courriel=?';
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'s',$email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $dbEmail, $dbPassword,$id,$nom,$prenom,$date_de_naissance,$telephone);
    mysqli_stmt_fetch($stmt);
    if($dbEmail && password_verify($mdp,$dbPassword)){
        return array("res"=>true,"id"=>$id,"nom"=>$nom,"prenom"=>$prenom,"dateNais"=>$date_de_naissance,"telephone"=>$telephone,"email"=>$dbEmail);
    }
    else{
        return array("res"=>false);
    }
}
/**
 * fonction qui permet de recuperer les informations d'un utilisateur a travers son email
 *
 * @param string $email
 * @return array
 */
function getUtilisateurByEmail2($email){
    $conn=connexionDB();
    $sql='select courriel,nom,prenom,date_de_naissance,telephone,id_utilisateur from utilisateur where courriel=?';
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'s',$email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $dbEmail,$nom,$prenom,$date_de_naissance,$telephone,$id_utilisateur);
    mysqli_stmt_fetch($stmt);
    return array("nom"=>$nom,"prenom"=>$prenom,"dateNais"=>$date_de_naissance,"telephone"=>$telephone,"email"=>$dbEmail,"id"=>$id_utilisateur);
}
/**
 * fonction de modifier les informations 
 *
 * @param [type] $data
 * @return void
 */
function modifierUtilisateur($data,$email){
    $new_nom=$data['nom'];
    $new_prenom=$data['prenom'];
    $new_courriel=$data['courriel'];
    $new_dateNais=$data['dateNais'];
    $new_telephone=$data['telephone'];
    $conn=connexionDB();
    $sql='update utilisateur set nom=?,prenom=?,courriel=?,date_de_naissance=?,telephone=? where courriel=?';
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'ssssss',$new_nom,$new_prenom,$new_courriel,$new_dateNais,$new_telephone,$email);
    return mysqli_stmt_execute($stmt);
}
/**
 * fonction qui permet d'ajouter un Produit dans le panier
 *
 * @param int $id_produit
 * @param int $quantite
 * @return void
 */
/*
function ajouterAuPanier($id_produit,$quantite){
    if(isset($_SESSION['panier'][$id_produit])){
        if($_SESSION['panier'][$id_produit]<getProduitById($id_produit)['quantite']){
            $_SESSION['panier'][$id_produit]++;
        }
        else{
            $_SESSION['panier'][$id_produit]=$quantite;
        }
    }
}*/
function ajouterAuPanier($id_produit, $quantite) {
    // Si le produit est déjà dans le panier, on met à jour la quantité
    if (isset($_SESSION['panier'][$id_produit])) {
        $_SESSION['panier'][$id_produit] += $quantite;
    } else {
        // Sinon, on l'ajoute avec la quantité spécifiée
        $_SESSION['panier'][$id_produit] = $quantite;
    }
}
/**
 * fonction qui permer d'afficher le panier
 *
 * @return array
 */
function getPanier(){
    if(!isset($_SESSION['panier']) || empty($_SESSION['panier'])){
        return [];
    }
    $panier=$_SESSION['panier'];
    $res=[];
    foreach($panier as $id => $quantite){
        $produit=getProduitById($id);
        if($produit !==null){
            $produit['quantite']=$quantite;
            $res[]=$produit;
        }
    }
    return $res;
}
/**
 * fonction qui permet d'afficher tout les utilisateurs
 *
 * @return array | false
 */
function getUtilisateurs(){
    $conn=connexionDB();
    $sql="select * from `utilisateur` right join role_utilisateur on utilisateur.id_utilisateur=role_utilisateur.id_utilisateur join role on role_utilisateur.id_role=role.id_role";
    $resultat=mysqli_query($conn,$sql);
    $utilisateurs=[];
    if(mysqli_num_rows($resultat)>0){
        foreach($resultat as $utilisateur){
            $utilisateurs[]=$utilisateur;
        }
        return $utilisateurs;
    }
    else{
        echo '<div class="alert alert-info" role="alert">
                Aucun Utilisateur
            </div>';
    }
}
/**
 * fonction qui permet de modofier le role d'un utilisateur
 *
 * @param int $id_utilisateur
 * @return mysqli | false
 */
/*
function updateRole($id_utilisateur){
    $conn=connexionDB();
    $sql="select id_role from role_utilisateur where id_utilisateur=?";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_utilisateur);
    $res=mysqli_stmt_execute($stmt);
    if($res){
        mysqli_stmt_bind_result($stmt,$role);
        mysqli_stmt_fetch($stmt);
        $stmt2=mysqli_prepare($conn,$sql);
        if($role==1){
           $newRole=2;
        }
        else{
            $newRole=1;
        }
        $sql='update role_utilisateur set id_role =? where id_utilisateur =?';
        mysqli_stmt_bind_param($stmt2,'ii',$newRole,$id_utilisateur);
        return mysqli_stmt_execute($stmt2);
    }
    else{
        return false;
    }
}*/
function updateRole($id_utilisateur) {
    $conn = connexionDB();
    $sql = "SELECT id_role FROM role_utilisateur WHERE id_utilisateur = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_utilisateur);
    $res = mysqli_stmt_execute($stmt);
    if ($res) {
        mysqli_stmt_bind_result($stmt, $currentRole);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        $newRole = ($currentRole == 1) ? 2 : 1;
        $sql = "UPDATE role_utilisateur SET id_role = ? WHERE id_utilisateur = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $newRole, $id_utilisateur);
        $result = mysqli_stmt_execute($stmt);
        return $result;
    } else {
        return false;
    }
}

/**
 * fonction qui permet de supprimer un utilisateur
 *
 * @param int $id_utilisateur
 * @return bool
 */
function supprimerUtilisateur($id_utilisateur){
    $conn=connexionDB();
    $sql="delete from utilisateur where id_utilisateur=?";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_utilisateur);
    return mysqli_stmt_execute($stmt);
}
/**
 * fonction qui permet d enregistrer une commande
 *
 * @return array
 */
function ajouterCommande($id_utilisateur,$quantite,$prix){
    $conn=connexionDB();
    $sql="insert into commande (id_utilisateur,quantite,prix,date_commande) values(?,?,?,?)";
    $stmt=mysqli_prepare($conn,$sql);
    $date = date('Y-m-d H:i:s');
    mysqli_stmt_bind_param($stmt,'iiss',$id_utilisateur,$quantite,$prix,$date);
    unset($_SESSION['panier']);
    mysqli_stmt_execute($stmt);
    return mysqli_insert_id($conn);
}
/**
 * fonction qui permet d afficher les commandes d un utilisateur
 *
 * @param int $id_utilisateur
 * @return array | string
 */
function getCommandesById($id_utilisateur){
    $conn=connexionDB();
    $sql="select id_commande,quantite,prix, date_commande from commande where id_utilisateur=?";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_utilisateur);
    $res=mysqli_stmt_execute($stmt);
    $res=mysqli_stmt_get_result($stmt);
    $commandes=[];
    if(mysqli_num_rows($res)>0){
        foreach($res as $commande){
            $commandes[]=$commande;
        }
        return $commandes;
    }
    else{
        echo '<div class="alert alert-info" role="alert">
                Aucune Commande ajoutée
            </div>';
        return [];
    }
}
/**
 * fonction qui permet de supprimer une commande
 *
 * @param int $id_commande
 * @return bool
 */
function supprimerCommande($id_commande){
    $conn=connexionDB();
    $sql="delete from commande where id_commande=?";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_commande);
    return mysqli_stmt_execute($stmt);
}
/**
 * fonction qui permet d afficher toutes les commandes 
 *
 * @return array
 */
function getAllCommandes(){
    $conn=connexionDB();
    $sql="select utilisateur.nom,date_commande,quantite,id_commande from commande join utilisateur on utilisateur.id_utilisateur=commande.id_utilisateur";
    $resultat=mysqli_query($conn,$sql);
    if(mysqli_num_rows($resultat)>0){
        $commandes=[];
        foreach($resultat as $commande){
            $commandes[]=$commande;
        }
        return $commandes;
    }
    else{
        echo '<div class="alert alert-info" role="alert">
                Aucune Commande a été finalisée.
            </div>';
        return [];
    }
}
/**
 * fonction qui permet d inserer dans la table produit_commande
 *
 * @param int $id_commande
 * @param int $id_produit
 * @param int $quantite
 * @return bool
 */
function insertCommandeProduit($id_commande,$id_produit,$quantite){
    $conn=connexionDB();
    $sql="insert into produit_commande values(?,?,?)";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'iii',$id_commande,$id_produit,$quantite);
    return mysqli_stmt_execute($stmt);
}
/**
 * fonction qui permet d afficher les details d'une commande
 *
 * @param int $id_commande
 * @return array
 */
function getcommandedétails($id_commande){
    $conn=connexionDB();
    $sql="SELECT commande.id_commande,
        produit_commande.quantite AS quantite,
       SUM(commande.quantite) AS total_quantite, 
       date_commande, 
       utilisateur.nom, 
       utilisateur.prenom, 
       utilisateur.courriel, 
       produit.prix_unitaire, 
       commande.prix, 
       produit.nom AS nom_produit 
FROM utilisateur 
JOIN commande ON commande.id_utilisateur = utilisateur.id_utilisateur 
JOIN produit_commande ON produit_commande.id_commande = commande.id_commande 
JOIN produit ON produit.id_produit = produit_commande.id_produit 
WHERE commande.id_commande = ? 
GROUP BY produit.nom";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_commande);
    mysqli_stmt_execute($stmt);
    $res=mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($res)>0){
        $details=[];
        foreach($res as $commande){
            $details[]=$commande;
        }
        return $details;
    }
    else{
        echo '<div class="alert alert-info" role="alert">
                erreur
            </div>';
        return [];
    }
}
function rechercherProduits($cle) {
    $conn=connexionDB();
    $sql="select p.*,i.chemin from produit p left join image i on p.id_produit=i.id_produit where categorie=?";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'s',$cle);
    $resultat=mysqli_stmt_execute($stmt);
    $resultat=mysqli_stmt_get_result($stmt);
    $livres=[];
    if(mysqli_num_rows($resultat)>0){
        foreach($resultat as $livre){
            $livres[]=$livre;
        }
        return $livres;
    }
    else{
        echo '<div class="alert alert-info" role="alert">
                Aucune Livre trouvé
            </div>';
        return [];
    }
}
?>