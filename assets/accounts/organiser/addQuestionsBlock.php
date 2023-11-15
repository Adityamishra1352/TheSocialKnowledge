<?php
session_start();
include '../../_dbconnect.php';

if (!isset($_SESSION['organiser']) && $_SESSION['organiser'] != true) {
    header('location:../../403.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: Add Test</title>
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
                        <a class="nav-link" href="organiser.php">Organiser Panel</a>
                    </li>
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar m-0"
                style="height:100vh;min-width:250px;">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <button class="btn btn-outline-success my-2" id="addQuestions_btn">
                                Add Questions
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Sidebar Item 2
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 col-lg-8">
                <div class="firstcontainer m-0 p-0">
                    <div id="carouselExampleAutoplaying" class="carousel slide  ml-0" data-bs-ride="carousel">
                        <div class="carousel-inner " style="width:60rem;height:80rem;">
                            <div class="carousel-item active">
                                <img src="../../images/5.jpeg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../../images/ISRO1.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../../images/1.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="container my-2 p-0 addQuestions_container" style="display:none;">
                    <ul>
                        <li>
                            <h6>Add Questions:</h6>
                        </li>
                    </ul>
                    <div class="container-fluid">
                        <label for="questionType"><b>Select type of question:</b></label>
                        <select name="questionType" id="questionType" class="form-control m-1" style="width:40%;">
                            <option value="mutlipleChoice">Multiple Choice</option>
                            <option value="textArea">Descriptive Question</option>
                        </select>
                    </div>
                    <div class="questionsContainer">
                        <div class="textAreaTypeQuestions container">
                            <form action="testQuestionUpload.php" method="post">
                                <span class="fw-bold fst-italic">Note:</span><span class="fst-italic text-secondary">
                                    Give three spaces
                                    for a line break.</span>
                                <div class="container my-2">
                                    <form id="question-form" action="uploadQuestions.php" method="post"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="test_id" value="<?php echo $_GET['test_id']; ?>">
                                        <input type="hidden" name="answer_type" id="answerType">
                                        <div id="questions">
                                        </div>
                                        <button type="button" class="btn btn-primary m-2" id="add-question">Add
                                            Question</button>
                                        <button type="submit" class="btn btn-success m-2">Submit</button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
        const firstContainer = document.querySelector(".firstcontainer");
        const addQuestions_container = document.querySelector(".addQuestions_container");
        const addQuestions_btn = document.querySelector("#addQuestions_btn");
        addQuestions_btn.onclick = () => {
            firstContainer.style.display = "none";
            addQuestions_container.style.display = "block";
        }
    </script>
</body>

</html>