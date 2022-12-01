<?php

use LDAP\Result;
    require("./connexion.php");
   
    $difficulty="";
    $number="";
    $qcm="";
    $question="";
    $answer="";

    
    //inserer les requetes ajouter par l'administrateur dans la base de données.
    if(isset($_POST['btn_ajout']))
    {
        $difficulty = $_POST['difficulty'];
        $qcm = $_POST['qcm'];
        $number = $_POST['number'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        $query = "INSERT INTO t_question_reponse(Type_Question, id_question, Qcm, Question, Reponse) VALUES('$difficulty','$number','$qcm','$question','$answer')";
        $q = $con ->prepare($query);
        $res = $q->execute();
        if($res){
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

    //bouton Supprimer
    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $query = "DELETE FROM t_question_reponse WHERE id_question = '$id'";
        $q = $con ->prepare($query);
        $res = $q->execute();
        if($res)
        {
            echo "Supprimer avec succès";
        }
        header("refresh:1; url=bd.php");
        exit;
    }

    //bouton modifier
    if(isset($_POST['btn_update']))
    {
        $difficulty = $_POST['difficulty'];
        $number = $_POST['number'];
        $qcm = $_POST['qcm'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        $query = "UPDATE t_question_reponse SET type_question='$difficulty', id_question='$number', QCM='$qcm', question='$question', reponse='$answer' WHERE id_question='$number'";
        $q = $con ->prepare($query);
        $res = $q->execute();

        if($res)
        {
            echo "modification successful";
        }
            header("refresh:1; url=bd.php");
            exit;

    }
?>