<?php
$host = "lucky.db.elephantsql.com";
$user = "nyjbtmho";
$pass = "WvPejF_xswmg5DlxRD7vtm8ZyLx0BaXw";
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