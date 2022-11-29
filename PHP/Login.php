<?php 
require("/laragon/www/PHP/connexion.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $uname=$_POST["uname"];
  $password=$_POST["password"];


  $password = hash("sha256",$_POST['password']);
  $query="SELECT * FROM t_admin_login WHERE pseudo='".$uname."'AND password='".$password."'";

  $q = $con ->prepare($query);
  $q -> execute();
  $row = $q -> fetch();

  var_dump($row);

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
      header("location: bd.php");
      exit;
    }
  }
  else
  {
    echo "username or password incorrect";
  } 
}


?>