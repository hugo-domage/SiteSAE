<?php
    require("./connexion.php");
    require("./actionchoix.php");


    // On vérifie si la session emailadm est enregistrée, si ce n'est pas le cas on redirige vers la page de connexion
    if ($_SESSION['emailadm'] == false)
    {
        header("location: ../HTML/Login.html");
        exit;
    }

    // On prépare une requête qui va compter le nombre d'entrées dans la table t_question_reponse
    $count =$con -> prepare("SELECT COUNT(id_question) as cpt from t_qcm_choix");
    $count -> setFetchMode(PDO::FETCH_ASSOC);
    $count -> execute();
    $tcount = $count -> fetchAll();

    //Pagination :
    // On récupère le paramètre page de l'URL.
    @$page=$_GET["page"];
    //Si la page n'est pas définie on initialise la page à 1.
    if(empty($page)) $page = 1;
    // On définit le nombre d'éléments par page.
    $nb_element_par_page = 35;
    // On calcule le nombre de pages totales.
    $nb_pages = ceil($tcount[0]["cpt"]/$nb_element_par_page);
    // On calcule la position de départ pour la requête.
    $start=($page-1)*$nb_element_par_page;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de données - SAE</title>
    <link rel="stylesheet" href="../CSS/Stylebd.css">
</head>
<body>
    <div class="pagination">
        <?php 
            for($i=1;$i<=$nb_pages;$i++){
                if($page!=$i)
                    echo "<a href='?page=$i'>$i</a>&nbsp;";
                else
                    echo"<a>$i</a>&nbsp;";
            }
        ?>
    </div>
    <div class="container col-md-12">
            <div class="tableau">
                <br>
                <h3>DATABASE :</h3>
                <hr>
            </div>
        <div class="rows">
            <div class= "tableau">
            <h3> Qcm TABLE </h3>
            <hr>
            <div class="table responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="Column">
                        <th>ID_QUESTION</th>
                        <th>TYPE_QUESTION</th>
                        <th>NUM_REPONSE</th>
                        <th>CHOIX_REPONSE</th>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include_once("connexion.php");

                    $query = "SELECT * FROM t_qcm_choix order by id_question limit $nb_element_par_page OFFSET $start";
                    $q = $con ->prepare($query);
                    $q->execute();
                    while($row = $q -> fetch())
                    {
                ?>
                    <tr class="Rows">
                        <td><?php echo $row['id_question']?></td>
                        <td><?php echo $row['type_question']?></td>
                        <td><?php echo $row['num_reponse']?></td>
                        <td><?php echo $row['choix_reponse']?></td>
                        <td><a href="actionchoix.php?delete=<?php echo $row['id_question'] ?>" class="Dbutton">Delete</a></td>
                        <td><a href="bdchoix.php?update=<?php echo $row['id_question']?>" class="Ubutton">Update</a></td>
                    </tr>
                    <?php
                        }
                     ?>
                </tbody>
            </table>
            </div>
            </div>
            <h3> Add Answers and number of answer </h3>
            <hr>
            <div>
                <form method="post" action="actionchoix.php">
                    <div class="form-group">
                        <label> Id of the question : </label>
                        <input type="text" name="number" class="form-control" value="<?php echo $id;?>" placeholder="Number" readonly="readonly"/>
                    </div>
                    <div class="form-group">
                        <label> Difficulty of the question (F, M, D) : </label>
                        <input type="text" name="difficulty" class="form-control" value="<?php echo $difficulty;?>" placeholder="Difficulty"/>
                    </div>
                    <div class="form-group">
                        <label> Numero de réponse</label>
                        <input type="text" name="numreponse" class="form-control" value="<?php echo $numreponse;?>" placeholder="numéro de réponse" />
                    </div>
                    <div class="form-group">
                        <label> Choix de réponse </label>
                        <input type="text" name="choixreponse" class="form-control" value="<?php echo $choixreponse;?>" placeholder="Reponse"/>
                    </div>
                    <div class="buttonDelUp">
                        <?php if($modifier==true){?>
                            <input type="submit" name="btn_edit" class="btn-save" value="Edit" />
                        <?php } else {?>
                            <input type="submit" name="btn_ajout" class="btn-save" value="Save" />
                        <?php } ?>
                    </div>
                </form>
                <div class="qcmbutton">
                    <a href="/PHP/bd.php">
                        <input type="button" value="Question reponse page -->"> 
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>