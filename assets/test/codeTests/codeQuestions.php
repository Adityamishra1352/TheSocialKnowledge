<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header('location:../403.php');
}
$test_id = $_GET['test_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Code Along</title>
    <link rel="stylesheet" href="../../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto" href="../../index.php">The Social Knowledge</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="container my-2">
        <?php
        include '../../_dbconnect.php';
        $questionSQL = "SELECT * FROM `codingquestions` WHERE `test_id`='$test_id'";
        $questionResult = mysqli_query($conn, $questionSQL);
        $countQuestion=1;
        while ($row = mysqli_fetch_assoc($questionResult)) {
            $questionID = $row["code_id"];
            $question = $row["question"];
            echo '<div class="card w-100 mb-3">
            <div class="card-body row">
              <h5 class="card-title col-md-10">Question '.$countQuestion.'.'.$question.'</h5>
              <a href="codeAlong.php?test_id='.$test_id.'&question_id='.$questionID.'" class="btn btn-outline-primary col-md-2">Attempt</a>
            </div>
          </div>';
          $countQuestion+=1;
        }
        ?>
    </div>
    <script src="../../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>

</html>