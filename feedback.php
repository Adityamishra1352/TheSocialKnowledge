<?php
include 'assets/_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $likedWebsite = $_POST['likedWebsite'];
    $forRecommendations = $_POST['forRecommendations'];
    $sql = "INSERT INTO `feedback` (`likewebsite`, `recommendations`, `timestamp`) VALUES ( '$likedWebsite', '$forRecommendations', current_timestamp());";
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: View Score</title>
    <link rel="stylesheet" href="assets/modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="assets/images/websitelogo.jpg" type="image/png">
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
                </ul>
            </div>
        </div>
    </nav>
    <div class="container p-1 my-2">
        <form class="form_input" action="feedback.php" method="post" style="width:40%">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Did you like the website?</label>
                <select id="likedWebsite" name="likedWebsite" class="form-select">
                    <option value="Yes">Yes</option>
                    <option value="Partially">Partially</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="forRecomendations"
                    name="forRecommendations"></textarea>
                <label for="forRecommendations">Recommendations</label>
            </div>
            <button type="submit" id="submit" class="btn btn-primary my-2">Submit</button>
        </form>
    </div>
</body>

</html>