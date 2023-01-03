<?php

use LDAP\Result;
    require("./connexion.php");
    session_start();
        $difficulty = "";
        $qcm = "";
        $question = "";
        $answer = "";

        $modifier="";
    //bouton save
    if(isset($_POST['btn_ajout']))
    {
        $difficulty = $_POST['difficulty'];
        $qcm = $_POST['qcm'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        //$query = "INSERT INTO t_question_reponse(Type_Question, Qcm, Question, Reponse, date_maj, id_adm) VALUES('$difficulty','$qcm','$question','$_SESSION['emailadm']', now(), 1)";
        //$q = $con ->prepare($query);
        //$res = $q->execute();
        $sql = "INSERT INTO t_question_reponse (Type_Question, Qcm, Question, Reponse, date_maj, emailadm) VALUES(:difficulty, :qcm, :question, :reponse, :date_maj, :emailadm)";
        $stmt= $con->prepare($sql);
        $stmt->execute([$difficulty, $qcm, $question, $answer, 'now()', $_SESSION['emailadm']]);

        if($stmt){
            echo "<div class= 'succes'>
                <h3>question ajouté avec succès</h3>
                </div>";
        }else{
            echo "<div class= 'error'>
                <h3>la question n'a pas été ajouté, il y a une erreur</h3>
                </div>";
        }
        header("refresh:1; url=bd.php");
        exit;
    }

    //bouton delete
    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $query = "DELETE FROM t_question_reponse WHERE id = '$id'";
        $q = $con ->prepare($query);
        $res = $q->execute();
        if($res)
        {
            echo "Supprimer avec succès";
        }
        header("refresh:1; url=bd.php");
        exit;
    }

    //bouton update qui affiche ce qu'on veut modifier dans le formulaire
    if(isset($_GET['update']))
    {
        $id = $_GET['update'];

        $sql = "SELECT * FROM t_question_reponse WHERE id='$id'";
        $stmt= $con->prepare($sql);
        $stmt -> execute();

        $row = $stmt -> fetch();

        $id = $row['id'];
        $difficulty = $row['type_question'];
        $qcm = $row['qcm'];
        $question = $row['question'];
        $answer = $row['reponse'];

        $modifier = true;
    
    }




    //bouton modify qui permet d'enregistrer les modifications
    if(isset($_POST['btn_edit']))
    {
        $difficulty = $_POST['difficulty'];
        $qcm = $_POST['qcm'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        $sql = 'UPDATE t_question_reponse ' . 'SET Type_question = :type_question, ' . 'Qcm = :qcm, ' . 'Question = :question, ' . 'Reponse = :reponse, ' . 'date_maj = :date_maj, ' . 'emailadm = :emailadm ' . 'WHERE id = :id';
        $stmt= $con->prepare($sql);
        $stmt->bindValue(':type_question', $difficulty);
        $stmt->bindValue(':qcm', $qcm);
        $stmt->bindValue(':question', $question);
        $stmt->bindValue(':reponse', $answer);
        $stmt->bindValue(':date_maj', 'now()');
        $stmt->bindValue(':emailadm', $_SESSION['emailadm']);
        $stmt->bindValue(':id', $id);
        $stmt -> execute();

        if($stmt)
        {
            echo "modification successful";
        }
            header("refresh:1; url=bd.php");
            exit;

    }


?>