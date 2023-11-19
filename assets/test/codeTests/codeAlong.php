<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header('location:../403.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Code Along</title>
    <link rel="stylesheet" href="../../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../modules/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <style>
        .fullScreenModal {
            backdrop-filter: blur(10px);
        }
    </style>
    <script>
        const question_id = <?php echo $_GET['question_id']; ?>;
        const test_id = <?php echo $_GET['test_id']; ?>;
    </script>
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
            <div class="navbarSupportedContent">
                <div class="container p-2 border border-danger" style="background-color:#ffbaba;border-radius:10px;">
                    <span>Time Left:</span>
                    <span id="timeRemaining"></span>
                </div>
            </div>
        </div>

    </nav>
    <!-- <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0"
        aria-valuemax="100" style="width:100%;height:3px">
        <div class="progress-bar bg-danger" style="width: 0%" id="timeProgressBar"></div>
    </div> -->
    <div class="modal fade fullScreenModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">The Social Knowledge</h1>
                </div>
                <div class="modal-body">
                    The Test can only be given in FullScreen mode!!!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="fullScreen_btn">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade gobackModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">The Social Knowledge</h1>
                </div>
                <div class="modal-body">
                    The answer has been submitted. Please go back!!
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Feature under maintainence.</strong> Some functions might not work.
    </div> -->
    <div class="container m-0 p-0" style="max-width:100%">
        <div class="control-panel p-1 container m-0" style="max-width:100%;display:flex;justify-content:flex-end;">
            <select class="form-select languages d-flex border-dark" id="languages" aria-label="Language"
                style="width:20%;" onchange="changeLanguage()">
                <option value="nodejs">NodeJS</option>
                <option value="c">C</option>
                <option value="cpp">C++</option>
                <option value="php">PHP</option>
                <option value="python">Python</option>
            </select>
            <a class="btn" style="font-size:20px;color:black;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                    class="fa fa-bars"></i></a>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editor Settings</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text"><b>Theme:</b></h6>
                                    <span class="text">Change the theme</span>
                                </div>
                                <div class="col-md-6">
                                    <select aria-label="theme" id="theme" class="form-select theme w-100 border-dark"
                                        onchange="changeTheme()">
                                        <option value="github">Github</option>
                                        <option value="chaos">Chaos</option>
                                        <option value="cobalt">Cobalt</option>
                                        <option value="nord_dark">Nord_dark</option>
                                        <option value="monokai">Monokai</option>
                                        <option value="sqlserver">SQL Server</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <h6 class="text "><b>Font Size</b></h6>
                                    <span class="text ">Change Font Size:</span>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" id="fontSizeInput" class="form-control border-dark"
                                        placeholder="Font Size" min="13" max="30" onchange="changeEditorFontSize()"
                                        style="width:40%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row codeEditor my-1" style="width:100%">
            <div class="col-md-4 container overflow-auto" draggable="true">
                <div class="container border" style="height:300px">
                    <?php
                    include '../../_dbconnect.php';
                    $test_id = $_GET['test_id'];
                    $question_id = $_GET['question_id'];
                    $questionSQL = "SELECT * FROM `codingquestions` WHERE `test_id`='$test_id' AND `code_id`='$question_id'";
                    $questionResult = mysqli_query($conn, $questionSQL);
                    $row = mysqli_fetch_assoc($questionResult);
                    $question = $row["question"];
                    echo '<h6 class="my-1"> Question:' . $question . '</h6>';
                    ?>
                </div>
                <div id="outputTerminal"></div>
            </div>
            <div class="col-md-8 m-0 p-0" style="overflow:auto;" draggable="true">
                <div class="editor container border" id="editor" style="width:100%;height:300px;font-size:15px;"></div>
                <div class="button-container container my-1">
                    <button class="btn btn-outline-success mr-1 ml-1" onclick="executeCode()">Run</button>
                    <button class="btn btn-outline-success ml-1" onclick="submitCode()" id="submitCode">Submit</button>
                    <button class="btn btn-outline-danger ml-1" onclick="clearCompiler()">Clear</button>
                </div>
                <div class="container inputContainer mb-3" id="inputContainer"
                    style="width:100%; height:auto;font-size:15px;">
                    <p class="d-inline-flex gap-1" style="width:100%">
                        <a class="btn border-dark" data-bs-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample" style="width:100%">
                            Test Against Custom Input:
                        </a>
                    </p>
                    <div class="collapse form-floating p-1" id="collapseExample">
                        <textarea name="inputArea" id="inputArea" style="width:100%;height:100%;"
                            class="form-control border" value=""></textarea>
                        <label for="inputArea">Custom Input:</label>
                        <div class="outputContainer container mb-3">
                            <div class="align-items-center" id="loader" style="display:none;width:95%;">
                                <strong class="text-primary" role="status">Loading...</strong>
                                <div class="spinner-grow text-primary ms-auto" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div class="outputScreen container border bg-dark" style="display:none;">
                                <div class="inputDiv container my-2">
                                    <label class="text-light">Input:</label>
                                    <div class="inputGiven container bg-secondary text-light p-2 rounded-top"
                                        style="width:100%"></div>
                                </div>
                                <div class="outputDiv container mb-3">
                                    <label class="text-light">Output:</label>
                                    <div class="output container bg-secondary text-light p-2 rounded-top"
                                        style="width:100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-4 m-0 p-0">
                <div class="container border" style="height:300px;">
                    <div class="align-items-center" id="loader" style="display:none;width:95%;">
                        <strong class="text-primary" role="status">Loading...</strong>
                        <div class="spinner-grow text-primary ms-auto" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="output container p-1" id="output" style="height:100%;overflow:auto;">
                    </div>
                </div>
                <button class="btn btn-outline-danger mr-1 my-1" onclick="clearOutput()">Clear Output</button>
            </div> -->
        </div>

    </div>
    <?php
    $timeSQL = "SELECT * FROM `codingtest` WHERE `test_id`='$test_id'";
    $timeResult = mysqli_query($conn, $timeSQL);
    $rowTimer = mysqli_fetch_assoc($timeResult);
    $time = $rowTimer["timefortest"];
    ?>
    <script>
        var timefortest = <?php echo $_SESSION['timeLeft']; ?>;
        console.log(timefortest);
    </script>
    <script>
        //timer
        function updateRemainingTime() {
            var currentTime = new Date().getTime() / 1000;
            var elapsedTime = Math.round(currentTime - startTime);
            var remainingTime = Math.max(0, Math.round(timefortest - elapsedTime));
            $.ajax({
                    url: 'updateTimeLeft.php',
                    type: 'POST',
                    data: { timeLeft: Math.round((timefortest) - elapsedTime) },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.error('Error updating time left:', error);
                    }
                });
            var minutes = Math.floor(remainingTime / 60);
            var seconds = remainingTime % 60;
            var formattedTime = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
            document.getElementById('timeRemaining').innerText = formattedTime;
            if (remainingTime <= 0) {
                clearInterval(intervalId);
            }
        }
        
        var startTime = new Date().getTime() / 1000;
        var intervalId = setInterval(updateRemainingTime, 1000);
    </script>
    <script src="../../modules/jquery/dist/jquery.min.js"></script>
    <script src="../../javascript/compiler/ace.js"></script>
    <script src="../../javascript/compiler/theme-github.js"></script>
    <script src="../../javascript/compiler/theme-chaos.js"></script>
    <script src="../../javascript/compiler/theme-cobalt.js"></script>
    <script src="../../javascript/compiler/theme-nord_dark.js"></script>
    <script src="../../javascript/compiler/theme-monokai.js"></script>
    <script src="../../javascript/compiler/theme-sqlserver.js"></script>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="../../javascript/codeAlong.js"></script>
</body>

</html>