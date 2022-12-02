<?php
    require("./connexion.php");
    require_once("./actionbd.php");

    //declaration
    $difficulty="";
    $number="";
    $qcm="";
    $question="";
    $answer="";
    $modify= false;

    // recup le nombre de ligne
    $count =$con -> prepare("SELECT COUNT(id_question) as cpt from t_question_reponse");
    $count -> setFetchMode(PDO::FETCH_ASSOC);
    $count -> execute();
    $tcount = $count -> fetchAll();

    //Pagination
    @$page=$_GET["page"];
    if(empty($page)) $page = 1;
    $nb_element_par_page = 15;
    $nb_pages = ceil($tcount[0]["cpt"]/$nb_element_par_page);
    $start=($page-1)*$nb_element_par_page;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de données - SAE</title>
    <link rel="stylesheet" href="../CSS/Stylebd.css?v=<?php echo time(); ?>">
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
            <h3> Questions and Answers TABLE </h3>
            <hr>
            <div class="table responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="Column">
                        <th>TYPE_QUESTION</th>
                        <th>ID_QUESTION</th>
                        <th>QCM</th>
                        <th>QUESTION</th>
                        <th>REPONSE</th>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include_once("connexion.php");

                    $query = "SELECT * FROM t_question_reponse limit $nb_element_par_page OFFSET $start";
                    $q = $con ->prepare($query);
                    $q->execute();
                    while($row = $q -> fetch())
                    {
                ?>
                    <tr class="Rows">
                        <td><?php echo $row['type_question']?></td>
                        <td><?php echo $row['id_question']?></td>
                        <td><?php echo $row['qcm']?></td>
                        <td><?php echo $row['question']?></td>
                        <td><?php echo $row['reponse']?></td>
                        <td><a href="actionbd.php?delete=<?php echo $row['id_question'] ?>" class="Dbutton">Delete</a></td>
                        <td><a href="bd.php?update=<?php echo $row['id_question']?>" class="Ubutton">Update</a></td>
                    </tr>
                    <?php
                        }
                     ?>
                </tbody>
            </table>
            </div>
            </div>
            <h3> Add questions and answers </h3>
            <hr>
            <div>
                <form method="post" action="actionbd.php">
                    <div class="form-group">
                        <label> Difficulty of the question (F, M, D) : </label>
                        <input type="text" name="difficulty" class="form-control" value="<?php echo $difficulty;?>" placeholder="Difficulty"/>
                    </div>
                    <div class="form-group">
                        <label> Id of the question : </label>
                        <input type="text" name="number" class="form-control" value="<?php echo $number;?>" placeholder="Number"/>
                    </div>
                    <div class="form-group">
                        <label> QCM (O,N) </label>
                        <input type="text" name="qcm" class="form-control" value="<?php echo $qcm;?>" placeholder="QCM" />
                    </div>
                    <div class="form-group">
                        <label> Question </label>
                        <input type="text" name="question" class="form-control" value="<?php echo $question;?>" placeholder="Question" />
                    </div>
                    <div class="form-group">
                        <label> Answer : </label>
                        <input type="text" name="answer" class="form-control" value="<?php echo $answer;?>" placeholder="Answer" />
                    </div>
                    <div class="buttonDelUp">
                        <input type="submit" name="btn_update" class="btn-update" value="Modify" />
                        <input type="submit" name="btn_ajout" class="btn-save" value="Save" />
                    </div>
                </form>
                <div class="qcmbutton">
                    <a href="/PHP/bdchoix.php">
                        <input type="button" value="Add answers to your qcm question -->"> 
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>