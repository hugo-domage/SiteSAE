<?php

use LDAP\Result;
    session_start();
    require("./connexion.php");

        // Initialisation des variables
        $id = "";
        $difficulty = "";
        $qcm = "";
        $question = "";
        $answer = "";

        $modifier="";

    // Traitement du formulaire d'ajout
    if(isset($_POST['btn_ajout']))
    {
        // Récupération des données
        $difficulty = $_POST['difficulty'];
        $qcm = $_POST['qcm'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        // Requête SQL pour insérer les données
        $sql = "INSERT INTO t_question_reponse (Type_Question, Qcm, Question, Reponse, date_maj, emailadm) VALUES(:difficulty, :qcm, :question, :reponse, :date_maj, :emailadm)";
        $stmt= $con->prepare($sql);
        $stmt->execute([$difficulty, $qcm, $question, $answer, 'now()', $_SESSION['emailadm']]);

        // Message de succès ou d'erreur
        if($stmt){
            echo "<div class= 'succes'>
                <h3>question ajouté avec succès</h3>
                </div>";
        }else{
            echo "<div class= 'error'>
                <h3>la question n'a pas été ajouté, il y a une erreur</h3>
                </div>";
        }
        // Redirection vers la page
        header("refresh:1; url=bd.php");
        exit;
    }

    
    // Traitement de la suppression
    if(isset($_GET['delete']))
    {
        // Récupération de l'id dans le lien
        $id = $_GET['delete'];
        // Requête SQL pour supprimer
        $query = "DELETE FROM t_question_reponse WHERE id = '$id'";
        $q = $con ->prepare($query);
        $res = $q->execute();
        // Message de succès ou d'erreur
        if($res)
        {
            echo "Supprimer avec succès";
        }
        // Redirection vers la page
        header("refresh:1; url=bd.php");
        exit;
    }

    // Traitement de la modification
    if(isset($_GET['update']))
    {
        // Récupération de l'id dans le lien
        $id = $_GET['update'];

        // Requête SQL pour récupérer les données
        $sql = "SELECT * FROM t_question_reponse WHERE id='$id'";
        $stmt= $con->prepare($sql);
        $stmt -> execute();

        // Récupération des données
        $row = $stmt -> fetch();

        $id = $row['id'];
        $difficulty = $row['type_question'];
        $qcm = $row['qcm'];
        $question = $row['question'];
        $answer = $row['reponse'];

        $modifier = true;
    
    }

    // Traitement du formulaire de modification
    if(isset($_POST['btn_edit']))
    {
        // Récupération des données
        $id = $_POST['id'];
        $difficulty = $_POST['difficulty'];
        $qcm = $_POST['qcm'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        // Requête SQL pour mettre à jour les données
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
    

        // Message de succès ou d'erreur
        if($stmt)
        {
            echo "modification successful";
        }
            // Redirection vers la page
            header("refresh:1; url=bd.php");
            exit;
            die;

    }