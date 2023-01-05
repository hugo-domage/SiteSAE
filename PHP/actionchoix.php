<?php

use LDAP\Result;
    require("./connexion.php");
    session_start();
    $difficulty="";
    $numreponse="";
    $choixreponse="";
    $id="";

    $modifier="";
    
    //inserer les requetes ajouter par l'administrateur dans la base de données.
    if(isset($_POST['btn_ajout']))
    {
        $difficulty = $_POST['difficulty'];
        $number = $_POST['number'];
        $numreponse = $_POST['numreponse'];
        $choixreponse = $_POST['choixreponse'];

        $sql = "INSERT INTO t_qcm_choix (Type_Question, id_question, num_reponse, choix_reponse, emailadm, date_maj) VALUES(:difficulty, :id_question, :num_reponse, :choix_reponse, :emailadm, :date_maj)";
        $stmt= $con->prepare($sql);
        $stmt->execute([$difficulty, $number, $numreponse, $choixreponse, $_SESSION['emailadm'], 'now()']);

        if($stmt){
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

        $sql = "SELECT * FROM t_qcm_choix WHERE id_question='$id'";
        $stmt= $con->prepare($sql);
        $stmt -> execute();

        $row = $stmt -> fetch();

        $difficulty = $row['type_question'];
        $id = $row['id_question'];
        $numreponse = $row['num_reponse'];
        $choixreponse = $row['choix_reponse'];

        $modifier = true;
    }

    //bouton modifier
    if(isset($_POST['btn_edit']))
    {
        $difficulty = $_POST['difficulty'];
        $number = $_POST['number'];
        $numreponse = $_POST['numreponse'];
        $choixreponse = $_POST['choixreponse'];

        $sql = 'UPDATE t_qcm_choix ' . 'SET Type_question = :type_question, ' . 'num_reponse = :num_reponse, ' . 'choix_reponse = :choix_reponse, '  . 'emailadm = :emailadm, ' . 'date_maj = :datemaj ' . 'WHERE id_question = :id_question';
        $stmt= $con->prepare($sql);
        $stmt->bindValue(':type_question', $difficulty);
        $stmt->bindValue(':id_question', $number);
        $stmt->bindValue(':num_reponse', $numreponse);
        $stmt->bindValue(':choix_reponse', $choixreponse);
        $stmt->bindValue(':emailadm', $_SESSION['emailadm']);
        $stmt->bindValue(':datemaj', 'now()');
        $stmt -> execute();

        if($stmt)
        {
            echo "modification successful";
        }
            header("refresh:1; url=bdchoix.php");
            exit;
    }
?>