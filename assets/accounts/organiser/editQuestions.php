<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Organiser</title>
    <link rel="stylesheet" href="../../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
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
        <?php
        include '../../_dbconnect.php';
        if (isset($_GET['question_id'])) {
            $questionId = $_GET['question_id'];
            $test_id=$_GET['test_id'];
            $sql = "SELECT * FROM `questions` WHERE `question_id`='$questionId'";
            $result = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_assoc($result)) {
                $question = $row['question'];
                $optionsJSON = $row['options'];
                $options = json_decode($optionsJSON, true);
                $answer = $row['answer'];
                ?>
                <form action="updateOptions.php" method="post">
                    <input type="hidden" name="question_id" value="<?php echo $questionId; ?>">
                    <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                    <div class="form-floating">
                        <textarea style="height:fit-content" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="editedQuestion"><?php echo $question; ?></textarea>
                        <label for="floatingTextarea">Edit Question:</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="editedOptions" id="floatingTextarea editedOptions" style="height:fit-content"><?php echo implode("\n", $options); ?></textarea>
                        <label for="floatingTextarea">Edit Options:</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="editedAnswer" id="floatingTextarea editedAnswer" style="height:fit-content"><?php echo $answer; ?></textarea>
                        <label for="floatingTextarea">Edit Answer:</label>
                    </div>
                    <button type="submit" class="btn btn-outline-success my-2" name="updateOptions">Update Question</button>
                </form>
                <?php
            } else {
                echo "Question not found.";
            }
        } else {
            echo "Invalid request.";
        }
        ?>

    </div>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>