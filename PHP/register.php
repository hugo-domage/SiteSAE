<?php
require('./connexion.php');

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = hash("sha256",$_POST['password']);

    $q = $con->prepare("SELECT * FROM t_login WHERE email= '$email'");
    $q->execute(); 
    $user = $q->fetch();
    if ($user) {
        echo "l'email existe déjà";
        header("refresh:1; url=../HTML/register.html");
    }   

    $q = $con ->prepare('INSERT INTO t_login (email, password) VALUES (:email, :password)');
    $q->bindValue('email', $email);
    $q->bindValue('password', $password);
    $res = $q->execute();
 
    if ($res) {
        echo "Inscription réussie";
    }
    header("refresh:1; url=../index.html"); 
}
?>

