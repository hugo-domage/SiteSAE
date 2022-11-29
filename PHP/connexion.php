<?php
$host = "lucky.db.elephantsql.com";
$user = "nyjbtmho";
$pass = "WvPejF_xswmg5DlxRD7vtm8ZyLx0BaXw";
$db = "nyjbtmho";

$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
 or die ("Could not connect to server\n");


// Closing connection
//pg_close($con);

  if (!empty($_GET['q'])) {
    switch ($_GET['q']) {
      case 'info':
        phpinfo(); 
        exit;
      break;
    }
  }
?>