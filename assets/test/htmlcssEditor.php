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
                        <a class="nav-link" href="codingBlock.php">C/C++/PHP/NodeJS</a>
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
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-4">
                <label for="html-editor"><b>HTML</b></label>
                <div id="html-editor" style="width:100%; height:350px;"></div>
            </div>
            <div class="col-12 col-md-4">
            <label for="css-editor"><b>CSS</b></label>
                <div id="css-editor" style="width:100%; height:350px;"></div>
            </div>
            <div class="col-12 col-md-4">
            <label for="js-editor"><b>JavaScript</b></label>
                <div id="js-editor" style="width:100%; height:350px;"></div>
            </div>
        </div>
    </div>
    <!-- <button class="btn btn-outline-success my-2" onclick="runCode()">Run Code</button> -->

    <div class="container my-2">
    <div class="output-container container border overflow-auto">
        <iframe id="output" class="output-iframe"></iframe>
    </div>
    </div>

    <script src="../jquery/dist/jquery.min.js"></script>
    <script src="../javascript/compiler/ace.js"></script>
    <script src="../javascript/compiler/theme-github.js"></script>
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="../javascript/htmlcssEditor.js"></script>
</body>

</html>