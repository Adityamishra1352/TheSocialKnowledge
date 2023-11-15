<?php
session_start();
include '../../_dbconnect.php';
if (
    !(isset($_SESSION['organiser']) && $_SESSION['organiser'] === true)
) {
    header('location: ../../403.php');
}
$test_id = $_GET['test_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Organiser</title>
    <link rel="stylesheet" href="../../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <script src="../../modules/chart.js/dist/chart.umd.js"></script>
    <link rel="stylesheet" href="../../modules/datatables.net-dt/css/jquery.dataTables.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../index.php">The Social Knowledge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                            aria-controls="offcanvasExample">
                            Test Options
                        </a>
                    </li>
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">The Social Knowledge: Code Along</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="row">
                        <div class="col-md-6">
                            View Responses for this test:
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-success" id="responses_btn">Responses</button>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="row">
                        <div class="col-md-6">
                            Add/Delete Questions for this test:
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-success" id="questions_btn">Add/Delete Questions</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="responses_container container my-2 p-2" style="display:none">
        <table class="table my-2 table-hover" id="responsesTable">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Name</th>
                    <th scope="col">Enrollment</th>
                    <th scope="col">Score</th>
                    <th scope="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="selectAll">
                            <label class="form-check-label" for="flexCheckDefault">
                                Allow Restart
                            </label>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                $sql = "SELECT * FROM `codinganswers` WHERE `test_id`='$test_id'";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                    $correct = $row['correct'];
                    $user_sql="SELECT * FROM `users` WHERE `user_id`='$user_id'";
                    $user_result = mysqli_query($conn, $user_sql);
                    $user_row = mysqli_fetch_assoc($user_result);
                    $user_id = $user_row["user_id"];
                    $name= $user_row['fname']." ".$user_row['lname'];
                    $enrollment=$user_row['enrollment'];
                    echo "<tr><th>$count</th><td><a href='viewUserCode.php?user_id=$user_id&test_id=$test_id'>$name</a></td><td>$enrollment</td><td>$correct</td><td><input type='checkbox' name='restart[]' value='$user_id' class='form-check-input'></td></tr>";
                    $count += 1;
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container my-2 addQuestions_container">
        <ul>
            <li><b>Add Questions:</b></li>
        </ul>
        <div class="container my-2">
            <form id="question-form" action="uploadCodingQuestions.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="test_id" value="<?php echo $_GET['test_id']; ?>">
                <input type="hidden" name="answer_type" id="answerType">
                <div id="questions">
                </div>
                <button type="button" class="btn btn-primary m-2" id="add-question">Add Question</button>
                <button type="submit" class="btn btn-success m-2">Submit</button>
            </form>
        </div>
        <div class="container my-2">
            <form action="deleteCodingQuestions.php?test_id=<?php echo $test_id; ?>" method="post">
                <ul>
                    <li>
                        <h4>Existing Questions:</h4>
                    </li>
                </ul>
                <table class="table my-2 table-hover" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Question</th>
                            <th scope="col">Testcase Array</th>
                            <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="selectAll">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Delete
                                    </label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $sql = "SELECT * FROM `codingquestions` WHERE `test_id`='$test_id'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $questionId = $row['code_id'];
                            $question = $row['question'];
                            $inputOutputJSON = $row['inputOutput'];
                            $inputOutput = json_decode($inputOutputJSON, true);
                            echo "<tr>
                        <th scope='row'>$count</th>
                        <td>$question</td>
                        <td>";
                            $countOption = 1;
                            echo $inputOutputJSON;
                            // foreach ($inputOutput as $inputs) {
                            //     echo "$countOption. $inputOuput<br>";
                            //     $countOption += 1;
                            // }
                        
                            echo "</td>
                        <td><input type='checkbox' name='delete[]' value='$questionId' class='form-check-input'></td>
                        </tr>";
                            $count += 1;
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-outline-danger my-2 me-2" name="deleteSelected">Delete
                    Selected</button>
            </form>
        </div>
    </div>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../javascript/codingQuestion.js"></script>
    <script src="../../modules/jquery/dist/jquery.min.js"></script>
    <script src="../../modules/datatables.net/js/jquery.dataTables.js"></script>
    <script>
        //data tables for searching ascending and decreasing order processes
        $(document).ready(function () {
            $('#mytable').DataTable();
            $('#responsesTable').DataTable();
        });

    </script>
</body>

</html>