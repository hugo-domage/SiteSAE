<?php
    require("./connexion.php");
    $difficulty="";
    $number="";
    $qcm="";
    $question="";
    $answer="";

    $modify="";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de données - SAE</title>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bd.css">
</head>
<body>
    <div class="container col-md-12">
        <div class="row">
            <div class="col-md-8">
                <br>
                <h3>DATABASE :</h3>
                <hr>
            </div>
        </div>
        <div class="rows">
            <div class= "col-md-8">
            <h3> Show data in Database </h3>
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

                    $query = "SELECT * FROM t_question_reponse";
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
                        <td><a href="action.php?delete=<?php echo $row['id_question'] ?>" class="btn btn-danger">Delete</a></td>
                        <td><a href="bd.php?update=<?php echo $row['id_question']?>" class="btn btn-info">Update</a></td>
                    </tr>
                    <?php
                        }
                     ?>
                </tbody>
            </table>
            </div>
            </div>
            <div class="col-md-4">
            <h3> Add questions and answers </h3>
            <hr>
            <form method="post" action="action.php">
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
                <div class="form-group">
                <?php if($modify==true){?>
                    <input type="submit" name="btn_update" class="btn btn-success" value="modify" />
                <?php } else { ?>
                    <input type="submit" name="btn_ajout" class="btn btn-primary" value="Save" />
                    <?php } ?>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>