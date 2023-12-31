<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header('location:../403.php');
}
include '../_dbconnect.php';
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Code Along</title>
    <link rel="stylesheet" href="../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
    <link rel="stylesheet" href="../modules/fontawesome-free-5.15.4-web/css/all.min.css">
    <!-- <style>
        .dark-theme {
            background-color: #1a1a1a;
            color: #ffffff;
        }
        .light-theme {
            background-color: #ffffff;
            color: #000000;
        }
    </style> -->
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
                        <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="htmlcssEditor.php">Frontend Development</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#saveModal" style="cursor:pointer"
                            onclick="savedCodes()">View Saved Files</a>
                    </li>
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../accounts/logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <!-- modal -->
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">The Social Knowledge</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row" style="overflow:auto">

                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Feature under maintainence.</strong> Give multiple inputs separated by comma (,)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="container m-0 p-0" style="max-width:100%">
        <div class="control-panel p-1 container m-0" style="max-width:100%;display:flex;justify-content:flex-end;">
            <select class="form-select languages d-flex border-dark" id="languages" aria-label="Language"
                style="width:20%;" onchange="changeLanguage()">
                <option value="none">Select a language</option>
                <option value="c">C</option>
                <option value="cpp">C++</option>
                <option value="php">PHP</option>
                <option value="py">Python</option>
                <option value="java">Java</option>
                <option value="sql">SQLite</option>
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
                                        <option value="twilight">Twilight</option>
                                        <option value="xcode">Xcode</option>
                                        <option value="one_dark">One_Dark</option>
                                        <option value="merbivore">Merbivore</option>
                                        <option value="dawn">Dawn</option>
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
                                        placeholder="Font Size" min="15" max="30" onchange="changeEditorFontSize()"
                                        style="width:40%">
                                </div>
                            </div>
                            <!-- <div class="row my-2">
                                <div class="col-md-6">
                                    <h6 class="text">Toggle Theme</h6>
                                    <span class="text">Change Theme:</span>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-outline-secondary ms-2" onclick="toggleTheme()">Toggle
                                        Theme</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row codeEditor" style="width:100%">
            <div class="col-md-8 m-0 p-0">
                <div class="editor container border" id="editor"
                    style="width:100%;height:300px;font-size:15px;overflow:auto;"></div>
                <div class="button-container container my-1">
                    <button class="btn btn-outline-success mr-1 ml-1" onclick="executeCode()">Compile</button>
                    <button class="btn btn-outline-danger ml-1" onclick="clearCompiler()">Clear</button>
                    <button class="btn btn-outline-primary mr-1 ml-1" onclick="saveCode()">Save Code</button>
                </div>
                <div class="inputSystem">
                    <p class="d-inline-flex gap-1" style="width:100%">
                        <a class="btn border-dark" data-bs-toggle="collapse" id="customInput" href="#collapseExample"
                            role="button" aria-expanded="false" aria-controls="collapseExample" style="width:100%">
                            Test Against Custom Input:
                        </a>
                    </p>
                    <div class="collapse form-floating p-1" id="collapseExample">
                        <textarea name="inputArea" id="inputArea" style="width:100%;height:100%;"
                            class="form-control border" value=""></textarea>
                        <label for="inputArea">Custom Input:</label>
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
                <div class="container">
                    <button class="btn btn-outline-danger mr-1 my-1" onclick="clearOutput()">Clear Output</button>
                </div>
            </div>
        </div>

    </div>
    <script>
        function savedCodes() {
            $.ajax({
                url: 'fetch_saved_files.php',
                method: 'GET',
                success: function (data) {
                    $('#saveModal .modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching saved files:', error);
                }
            });
        }

    </script>
    <script src="../modules/jquery/dist/jquery.min.js"></script>
    <script src="../javascript/compiler/ace.js"></script>
    <script src="../javascript/compiler/theme-github_dark.js"></script>
    <script src="../javascript/compiler/theme-dawn.js"></script>
    <script src="../javascript/compiler/theme-merbivore.js"></script>
    <script src="../javascript/compiler/theme-one_dark.js"></script>
    <script src="../javascript/compiler/theme-twilight.js"></script>
    <script src="../javascript/compiler/theme-xcode.js"></script>
    <script src="../javascript/compiler/theme-chaos.js"></script>
    <script src="../javascript/compiler/theme-cobalt.js"></script>
    <script src="../javascript/compiler/theme-nord_dark.js"></script>
    <script src="../javascript/compiler/theme-monokai.js"></script>
    <script src="../javascript/compiler/theme-sqlserver.js"></script>
    <script src="../javascript/compiler/ext-language_tools.js"></script>
    <script src="../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="../javascript/codingBlock.js"></script>
</body>

</html>