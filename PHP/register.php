<?php
require('./connexion.php');

if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $password = hash("sha256",$_POST['password']);
    
    $pseudo = $_POST['pseudo'];
    $q = $con->prepare("SELECT * FROM t_admin_login WHERE pseudo= '$pseudo'");
    $q->execute(); 
    $user = $q->fetch();
    if ($user) {
        echo "le nom d'utilisateur existe déjà";
        header("refresh:1; url=../HTML/register.html");
    }   
    die;

    $q = $con ->prepare('INSERT INTO t_admin_login (pseudo, password) VALUES (:pseudo, :password)');
    $q->bindValue('pseudo', $pseudo);
    $q->bindValue('password', $password);
    $res = $q->execute();
 
    if ($res) {
        echo "Inscription réussie";
    }
    header("refresh:1; url=../index.html"); 
}
?>

