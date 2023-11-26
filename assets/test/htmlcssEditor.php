<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Code Along</title>
    <script src="../modules/jquery-ui-1.13.2/external/jquery/jquery.js"></script>
    <script src="../modules/jquery-ui-1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../modules/jquery-ui-1.13.2/jquery-ui.min.css">
    <link rel="stylesheet" href="../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
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
    <div class="container" style="height:400px;overflow:hidden">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-4 resizable-editor border border-secondary" id="html-editor-container">
                <label for="html-editor"><b>HTML</b></label>
                <div id="html-editor" class="ace_editor" style="width:100%; height:350px;"></div>
            </div>
            <div class="col-12 col-md-4 resizable-editor border border-secondary" id="css-editor-container">
                <label for="css-editor"><b>CSS</b></label>
                <div id="css-editor" class="ace_editor" style="width:100%; height:350px;"></div>
            </div>
            <div class="col-12 col-md-4 resizable-editor border border-secondary" id="js-editor-container">
                <label for="js-editor"><b>JavaScript</b></label>
                <div id="js-editor" class="ace_editor" style="width:100%; height:350px;"></div>
            </div>
        </div>
    </div>

    <!-- <button class="btn btn-outline-success my-2" onclick="runCode()">Run Code</button> -->

    <div class="container my-2">
        <div class="output-container container border overflow-auto" style="width:100%">
            <iframe id="output" class="output-iframe" style="width:100%"></iframe>
        </div>
    </div>
    <!-- <script src="../modules/jquery/dist/jquery.min.js"></script> -->
    <script src="../javascript/compiler/ace.js"></script>
    <script src="../javascript/compiler/theme-github.js"></script>
    <script src="../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="../javascript/htmlcssEditor.js"></script>
    <script>
        $(function () {
            $(".resizable-editor").resizable({
                handles: "e",
                minWidth: 150,
                maxWidth: 1000,
                resize: function (event, ui) {
                    const htmlWidth = ui.size.width;
                    const remainingWidth = (htmlWidth - 2) / 2;
                    $(this).siblings(".resizable-editor").width(remainingWidth);
                    $(this).add($(this).siblings(".resizable-editor")).find(".ace_editor").each(function () {
                        ace.edit(this).resize();
                    });
                }
            });
        });
    </script>
</body>

</html>