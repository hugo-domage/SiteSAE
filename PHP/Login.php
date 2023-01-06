<?php 
//On récupère le fichier de connexion à la BD
require("connexion.php");

//On démarre une session
session_start();

//Si une requête POST a été envoyée
if($_SERVER["REQUEST_METHOD"]=="POST") {

  //On récupère l'email et le mot de passe entrés
  $email=$_POST["email"];
  $password= $_POST["password"];

  //On hash le mot de passe pour le comparer à celui de la BD
  $password = hash("sha256",$_POST['password']);

  //On prépare la requête de recherche
  $query="SELECT * FROM t_login WHERE email='".$email."'AND password='".$password."'";
  
  //On exécute la requête
  $q = $con ->prepare($query);
  $q -> execute();
  $row = $q -> fetch();

  //On enregistre l'email utilisé pour se connecter dans une variable de session
  $_SESSION['emailadm'] = $email;

  //On définit la page où l'utilisateur sera redirigé par défaut
  $location = "Location: ../HTML/Login.html";
 
  
    //Si un utilisateur est trouvé
    if ($row) {
      //Si le mot de passe et l'email correspondent à ceux présents dans la BD
      if ($password == $row["password"] && $email == $row["email"]) {
        //Si l'utilisateur est un administrateur
        if($row["usertype"]=="Admin")
        {
          //Message de confirmation
          echo "Admin connexion successful";

          //On définit la page où le rediriger
          $location = "Location: bd.php";
        }
      //Si l'utilisateur n'est pas un administrateur
      else{
        //On définit la page où le rediriger
        $location = "Location: ../HTML/game.html";
      }
    }
  }

  //Si aucun utilisateur n'a été trouvé
  echo "username or password incorrect";

  //On redirige l'utilisateur vers la page définie
  header($location);
}


?>