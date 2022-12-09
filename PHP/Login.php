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



  $location = "Location: ../HTML/Login.html";
 
  
    if ($row) {
      if ($password == $row["password"] && $email == $row["email"]) {
        if($row["usertype"]=="Admin")
        {
          echo "Admin connexion successful";
          $location = "Location: bd.php";
        }
    }
  }

  echo "username or password incorrect";
  header($location);
}


?>