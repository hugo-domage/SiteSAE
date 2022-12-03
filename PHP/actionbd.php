<?php

use LDAP\Result;
    require("./connexion.php");

    
   
    $difficulty="";
    $number="";
    $qcm="";
    $question="";
    $answer="";
    
    
    //bouton save
    if(isset($_POST['btn_ajout']))
    {
        $difficulty = $_POST['difficulty'];
        $qcm = $_POST['qcm'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        $query = "INSERT INTO t_question_reponse(Type_Question, Qcm, Question, Reponse, date_maj, id_adm) VALUES('$difficulty','$qcm','$question','$answer', now(), 1)";
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

    //bouton update

    if(isset($_GET['update']))
    {
        $id = $_GET['update'];
        header("refresh:1; url=modifybd.php");
        exit;
    }




    //bouton modify
    if(isset($_POST['btn_update']))
    {
        $difficulty = $_POST['difficulty'];
        $number = $_POST['number'];
        $qcm = $_POST['qcm'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        $query = "UPDATE t_question_reponse SET type_question='$difficulty', id='$number', QCM='$qcm', question='$question', reponse='$answer', id_adm= 1 , date_maj= now() WHERE id='$number'";
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