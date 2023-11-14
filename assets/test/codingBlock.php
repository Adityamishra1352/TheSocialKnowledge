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
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
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
                    <li class="nav-item">
                        <a class="nav-link" href="htmlcssEditor.php">Frontend Development</a>
                    </li>
                </ul>
                <ul class="d-flex" style="width:20%;">
                    <input type="number" id="fontSizeInput" class="form-control" placeholder="Font Size" min="13"
                        max="30" onchange="changeEditorFontSize()">
                </ul>

                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Feature under maintainence.</strong> Some functions might not work. Check out the Frontend Development
        Feature.
    </div>
    <div class="alert alert-warning alert-dismissible fade show input-warning" role="alert" style="display:none;">
        You should choose wheather or not you want inputs.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="container m-0 p-0" style="max-width:100%">
        <div class="control-panel p-1 container" style="width:100%;display:flex;justify-content:flex-end;">
            <select class="form-select languages d-flex" id="languages" aria-label="Language" style="width:20%;"
                onchange="changeLanguage()">
                <option value="js">NodeJS</option>
                <option value="c">C</option>
                <option value="cpp">C++</option>
                <option value="php">PHP</option>
                <option value="py">Python</option>
            </select>
        </div>
        <div class="row codeEditor" style="width:100%">
            <div class="col-md-8 m-0 p-0">
                <div class="editor container border" id="editor"
                    style="width:100%;height:300px;font-size:15px;overflow:auto;"></div>
                <div class="button-container container my-1">
                    <button class="btn btn-outline-success mr-1 ml-1" onclick="executeCode()">Compile</button>
                    <button class="btn btn-outline-danger ml-1" onclick="clearCompiler()">Clear</button>
                </div>
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
                            <!-- <div class="outputScreen container border bg-dark" style="display:none;">
                            <div class="inputDiv container my-2">
                                <label class="text-light">Input:</label>
                                <div class="inputGiven container bg-secondary text-light p-2 rounded-top" style="width:100%"></div>
                            </div>
                            <div class="outputDiv container mb-3">
                                <label class="text-light">Output:</label>
                                <div class="container bg-secondary text-light p-2 rounded-top" style="width:100%"></div>
                            </div>
                            </div> -->
                        </div>
                    </div>
            </div>
            <div class="col-md-4 m-0 p-0">
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
            </div>
        </div>

    </div>

    <script src="../jquery/dist/jquery.min.js"></script>
    <script src="../javascript/compiler/ace.js"></script>
    <script src="../javascript/compiler/theme-github.js"></script>
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="../javascript/codingBlock.js"></script>
</body>

</html>