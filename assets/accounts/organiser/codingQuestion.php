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
    <link rel="stylesheet" href="../../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <script src="../../chart.js/dist/chart.umd.js"></script>
    <link rel="stylesheet" href="../../datatables.net-dt/css/jquery.dataTables.css">
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
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-2">
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
            <form action="deleteQuestions.php?test_id=<?php echo $test_id; ?>" method="post">
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
                            <th scope="col">Options</th>
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
    <script src="../../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../javascript/codingQuestion.js"></script>
    <script src="../../jquery/dist/jquery.min.js"></script>
    <script src="../../datatables.net/js/jquery.dataTables.js"></script>
    <script>
        //data tables for searching ascending and decreasing order processes
        $(document).ready( function () {
    $('#mytable').DataTable();
} );

    </script>
</body>

</html>