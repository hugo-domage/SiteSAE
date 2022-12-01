<?php
    require("./connexion.php");
    require_once("./actionchoix.php");
    $difficulty="";
    $number="";
    $numreponse="";
    $choixreponse="";

    $modify= false;
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
    <div class="container col-md-12">
            <div class="tableau">
                <br>
                <h3>DATABASE :</h3>
                <hr>
            </div>
        <div class="rows">
            <div class= "tableau">
            <h3> Show data in Database </h3>
            <hr>
            <div class="table responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="Column">
                        <th>TYPE_QUESTION</th>
                        <th>ID_QUESTION</th>
                        <th>NUM_REPONSE</th>
                        <th>CHOIX_REPONSE</th>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include_once("connexion.php");

                    $query = "SELECT * FROM t_qcm_choix";
                    $q = $con ->prepare($query);
                    $q->execute();
                    while($row = $q -> fetch())
                    {
                ?>
                    <tr class="Rows">
                        <td><?php echo $row['type_question']?></td>
                        <td><?php echo $row['id_question']?></td>
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
                        <label> Difficulty of the question (F, M, D) : </label>
                        <input type="text" name="difficulty" class="form-control" value="<?php echo $difficulty;?>" placeholder="Difficulty"/>
                    </div>
                    <div class="form-group">
                        <label> Id of the question : </label>
                        <input type="text" name="number" class="form-control" value="<?php echo $number;?>" placeholder="Number"/>
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
                        <input type="submit" name="btn_update" class="btn-update" value="modify" />
                        <input type="submit" name="btn_ajout" class="btn-save" value="Save" />
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