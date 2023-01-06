<?php
// Ce code permet de vérifier si l'email entré par l'utilisateur existe déjà dans la base de données et, si ce n'est pas le cas, d'ajouter les informations de l'utilisateur à la base de données.

require('./connexion.php'); // Connexion à la base de données

if (!empty($_POST['email']) && !empty($_POST['password'])) { // Si l'email et le mot de passe ne sont pas vides
    $email = $_POST['email']; // Enregistrer l'email entré par l'utilisateur dans une variable
    $password = hash("sha256",$_POST['password']); // Hacher le mot de passe entré par l'utilisateur avec la fonction SHA256

    $q = $con->prepare("SELECT * FROM t_login WHERE email= '$email'"); // Préparer une requête pour vérifier si l'email a déjà été enregistré
    $q->execute(); // Exécuter la requête
    $user = $q->fetch(); // Récupérer les résultats
    if ($user) { // Si un utilisateur existe déjà avec cet email
        echo "l'email existe déjà"; // Afficher un message d'erreur
        header("refresh:1; url=../index.html"); // Rediriger l'utilisateur vers la page d'accueil
        exit; // Quitter le script
    }   

    $query = "INSERT INTO t_login(email, password, usertype) VALUES('$email','$password','User')"; // Préparer la requête d'insertion des informations de l'utilisateur dans la base de données
    $q = $con ->prepare($query); // Préparer la requête
    $res = $q->execute(); // Exécuter la requête
    if ($res) { // Si la requête s'est bien exécutée
        echo "Inscription réussie"; // Afficher un message de succès
    }
    header("refresh:1; url=../index.html"); // Rediriger l'utilisateur vers la page d'accueil
    exit; // Quitter le script
}
?>