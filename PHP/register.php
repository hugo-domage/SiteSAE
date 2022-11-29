<?php
require('./connexion.php');

if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $password = hash("sha256",$_POST['password']);
 
    var_dump($pseudo);
    var_dump($password);
 
    $q = $con ->prepare('INSERT INTO t_admin_login (pseudo, password) VALUES (:pseudo, :password)');
    $q->bindValue('pseudo', $pseudo);
    $q->bindValue('password', $password);
    $res = $q->execute();
 
    if ($res) {
        echo "Inscription réussie";
    }
}
?>

