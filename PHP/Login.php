<?php 
require("/laragon/www/PHP/connexion.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $email=$_POST["email"];
  $password=$_POST["password"];


  $password = hash("sha256",$_POST['password']);
  $query="SELECT * FROM t_login WHERE email='".$email."'AND password='".$password."'";

  $q = $con ->prepare($query);
  $q -> execute();
  $row = $q -> fetch();
 
  

  if($row == true){
    if ($row) {
      if ($password == $row["password"]) {
          echo "Connexion réussie !";
      } else {
          echo "Identifiants invalides";
      }
    }

    if($row["usertype"]=="Admin")
    {
      echo "Admin connexion successful";
      var_dump($row["id"]);
      header("refresh:1 url=bd.php");
      exit;
    }
  }
  else
  {
    echo "username or password incorrect";
  } 
}


?>