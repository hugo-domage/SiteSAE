<?php

use LDAP\Result;
    require("./connexion.php");
   
    $difficulty="";
    $number="";
    $numreponse="";
    $choixreponse="";
    
    //inserer les requetes ajouter par l'administrateur dans la base de données.
    if(isset($_POST['btn_ajout']))
    {
        $difficulty = $_POST['difficulty'];
        $number = $_POST['number'];
        $numreponse = $_POST['numreponse'];
        $choixreponse = $_POST['choixreponse'];

        $query = "INSERT INTO t_qcm_choix(type_question, id_question, num_reponse, choix_reponse, date_maj, id_adm) VALUES('$difficulty','$number','$numreponse','$choixreponse',now(), 1)";
        $q = $con ->prepare($query);
        $res = $q->execute();

        if($res){
            echo "<div class= 'succes'>
                <h3>reponse ajouté avec succès</h3>
                </div>";
        }else{
            echo "<div class= 'error'>
                <h3>les réponses n'ont pas été ajouté, il y a une erreur</h3>
                </div>";
        }
        header("refresh:1; url=bdchoix.php");
        exit;
    }

    //bouton Supprimer
    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $query = "DELETE FROM t_qcm_choix WHERE id_question = '$id'";
        $q = $con ->prepare($query);
        $res = $q->execute();
        if($res)
        {
            echo "Supprimer avec succès";
        }
        header("refresh:1; url=bdchoix.php");
        exit;
    }

    //boutton update
    if(isset($_GET['update']))
    {
        $id = $_GET['update'];
        header("refresh:1; url=modifychoix.php");
        exit;
    }

    //bouton modifier
    if(isset($_POST['btn_update']))
    {
        $difficulty = $_POST['difficulty'];
        $number = $_POST['number'];
        $numreponse = $_POST['numreponse'];
        $question = $_POST['choixreponse'];

        $query = "UPDATE t_qcm_choix SET type_question='$difficulty', id_question='$number', num_reponse='$numreponse', choix_reponse='$choixreponse', id_adm= 1, date_maj= now() WHERE id_question='$number'";
        $q = $con ->prepare($query);
        $res = $q->execute();

        if($res)
        {
            echo "modification successful";
        }
            header("refresh:1; url=bdchoix.php");
            exit;
    }
?>