<?php

use LDAP\Result;
    session_start();
    require("./connexion.php");

    // Initialisation des variables
    $difficulty="";
    $numreponse="";
    $choixreponse="";
    $id="";

    $modifier="";
    
    // Si le bouton "Ajouter" est cliqué
    if(isset($_POST['btn_ajout']))
    {
        // Récupérer les données du formulaire
        $difficulty = $_POST['difficulty'];
        $number = $_POST['number'];
        $numreponse = $_POST['numreponse'];
        $choixreponse = $_POST['choixreponse'];

        // Requête SQL pour insérer les données dans la base de données
        $sql = "INSERT INTO t_qcm_choix (Type_Question, id_question, num_reponse, choix_reponse, emailadm, date_maj) VALUES(:difficulty, :id_question, :num_reponse, :choix_reponse, :emailadm, :date_maj)";
        $stmt= $con->prepare($sql);
        $stmt->execute([$difficulty, $number, $numreponse, $choixreponse, $_SESSION['emailadm'], 'now()']);

        // Si la requête est exécutée avec succès
        if($stmt){
            echo "<div class= 'succes'>
                <h3>reponse ajouté avec succès</h3>
                </div>";
        }else{
            echo "<div class= 'error'>
                <h3>les réponses n'ont pas été ajouté, il y a une erreur</h3>
                </div>";
        }
        // Redirection vers la page d'accueil
        header("refresh:1; url=bdchoix.php");
        exit;
    }

    // Si le bouton "Supprimer" est cliqué
    if(isset($_GET['delete']))
    {
        // Récupérer l'id
        $id = $_GET['delete'];
        // Requête SQL pour supprimer l'enregistrement correspondant
        $query = "DELETE FROM t_qcm_choix WHERE id_question = '$id'";
        $q = $con ->prepare($query);
        $res = $q->execute();
        // Si la requête est exécutée avec succès
        if($res)
        {
            echo "Supprimer avec succès";
        }
        // Redirection vers la page d'accueil
        header("refresh:1; url=bdchoix.php");
        exit;
    }

    // Si le bouton "Modifier" est cliqué
    if(isset($_GET['update']))
    {
        // Récupérer l'id
        $id = $_GET['update'];

        // Requête SQL pour récupérer les données correspondantes à l'id
        $sql = "SELECT * FROM t_qcm_choix WHERE id_question='$id'";
        $stmt= $con->prepare($sql);
        $stmt -> execute();

        // Récupérer les données
        $row = $stmt -> fetch();

        $difficulty = $row['type_question'];
        $id = $row['id_question'];
        $numreponse = $row['num_reponse'];
        $choixreponse = $row['choix_reponse'];

        // Mettre à jour la variable modifier
        $modifier = true;
    }

    // Si le bouton "Modifier" du formulaire est cliqué
    if(isset($_POST['btn_edit']))
    {
        // Récupérer les données du formulaire
        $difficulty = $_POST['difficulty'];
        $number = $_POST['number'];
        $numreponse = $_POST['numreponse'];
        $choixreponse = $_POST['choixreponse'];

        // Requête SQL pour mettre à jour les données dans la base de données
        $sql = 'UPDATE t_qcm_choix ' . 'SET Type_question = :type_question, ' . 'num_reponse = :num_reponse, ' . 'choix_reponse = :choix_reponse, '  . 'emailadm = :emailadm, ' . 'date_maj = :datemaj ' . 'WHERE id_question = :id_question';
        $stmt= $con->prepare($sql);
        $stmt->bindValue(':type_question', $difficulty);
        $stmt->bindValue(':id_question', $number);
        $stmt->bindValue(':num_reponse', $numreponse);
        $stmt->bindValue(':choix_reponse', $choixreponse);
        $stmt->bindValue(':emailadm', $_SESSION['emailadm']);
        $stmt->bindValue(':datemaj', 'now()');
        $stmt -> execute();

        // Si la requête est exécutée avec succès
        if($stmt)
        {
            echo "modification successful";
        }
        // Redirection vers la page d'accueil
            header("refresh:1; url=bdchoix.php");
            exit;
    }
