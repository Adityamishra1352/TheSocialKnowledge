<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Tests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin1.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">The Social Knowledge</a>
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
                <ul class="d-flex">
                    <?php
                    session_start();
                    // echo $_SESSION['user_id'];
                    if (!isset($_SESSION['loggedin']) || $_SESSION['user_id'] == NULL) {
                        echo '<button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../accounts/login.php`)">Login</button>';
                    } else {
                        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                            echo '<button class="btn btn-outline-danger me-2"
                            onclick="window.location.href=(`../accounts/admin/admin.php`)">Admin Controls</button>';
                        } elseif (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                            echo '<button class="btn btn-outline-danger me-2"
                            onclick="window.location.href=(`../accounts/organiser/organiser.php`)">Organiser Controls</button>';
                        } else {
                            echo '<button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../accounts/dashboard.php`)">Dashboard</button>';
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-2">
        <div class="row">
            <?php
            include '../_dbconnect.php';
            $test_sql = "SELECT * FROM `test` WHERE `displayed`=1";
            $test_result = mysqli_query($conn, $test_sql);
            while ($rowTest = mysqli_fetch_assoc($test_result)) {
                $test_id = $rowTest['test_id'];
                $heading = $rowTest['heading'];
                $timeDate = $rowTest['time'];
                $timestamp = strtotime($timeDate);
                $formattedDate = date('d F Y', $timestamp);         
                $description = $rowTest['description'];
                echo '<div class="col"><div class="card" style="width: 18rem;">
                <img src="https://source.unsplash.com/400x400/?' . $heading . ',programming" class="card-img-top" alt="' . $heading . '">
                <div class="card-body">
                  <h5 class="card-title">' . $heading . '</h5>
                  <p class="card-text text-secondary">' . $formattedDate . '</p>
                  <p class="card-text">' . $description . '</p>
                  <a href="quizFeaturetry.php?testid=' . $test_id . '" class="btn btn-outline-success">Attend Test</a>
                </div>
              </div></div>';
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>