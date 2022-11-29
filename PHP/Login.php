<?php 
include_once("/laragon/www/PHP/connexion.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $uname=$_POST["uname"];
  $password=$_POST["password"];

  $query="SELECT * FROM t_admin_login WHERE pseudo='".$uname."'AND password='".$password."'";

  $result=pg_query($con,$query);
  $row=pg_fetch_array($result);
  if($row == true){
    if($row["usertype"]=="User")
    {
        echo "connected as a User";
        header("location: ../index.html ");
        exit;
    }
    elseif($row["usertype"]=="Admin")
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