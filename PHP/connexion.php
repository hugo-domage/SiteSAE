<?php
// Identifiants de la BD
$host = "lucky.db.elephantsql.com";
$user = "nyjbtmho";
$pass = "ILZMPn922ytEsKA_D5HGKSBIGo7rT7of";
$db = "nyjbtmho";

try{
  // Connexion à la base de données
  $con = new PDO("pgsql:host=$host; port=5432; dbname=$db; user=$user; password=$pass");

    if (!empty($_GET['q'])) {
      switch ($_GET['q']) {
        case 'info':
          phpinfo(); 
          exit;
      }
    }
  }catch(PDOException $e){
    // Afficher un message d'erreur
    echo $e->getMessage();
    }

    // Si la connexion échoue
    if (null == $con){
    // Arrêter le script
    exit;
  }
?>