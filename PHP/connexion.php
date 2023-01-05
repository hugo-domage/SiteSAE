<?php
$host = "lucky.db.elephantsql.com";
$user = "nyjbtmho";
$pass = "ILZMPn922ytEsKA_D5HGKSBIGo7rT7of";
$db = "nyjbtmho";

try{


$con = new PDO("pgsql:host=$host; port=5432; dbname=$db; user=$user; password=$pass");


// Closing connection
//pg_close($con);

  if (!empty($_GET['q'])) {
    switch ($_GET['q']) {
      case 'info':
        phpinfo(); 
        exit;
    }
  }
}catch(PDOException $e){
  echo $e->getMessage();
  }

  if (null == $con){
    exit;
  }
?>