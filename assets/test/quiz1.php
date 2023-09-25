<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Organiser</title>
    <script src="certificategenerator/certificate-gen.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <script src="https://kit.fontawesome.com/8f9eb736b1.js" crossorigin="anonymous"></script>
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
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-3">
        <div class="certificate_box">
            <div class="certificate_text">
                <!-- <label for="name"><b>Type Your Name</b></label> -->
                <!-- <input type="text" name="Name" id="name" placeholder="Enter your name" required> -->
                <div class="buttons">
                    <label>Tap on the button to get your certificate:</label> <br>
                    <button id="certification" class="btn btn-primary">Get Certificate</button>
                    <button id="gobacktoresult" class="btn btn-primary">Go Back to the Reusult Page</button>
                    <button onclick="window.location.href='/index.html'" class="btn btn-primary">Home</button>
                </div>
                <div class="container p-2">
                <iframe src="" id="certificatepdf" frameborder="0" style="width: 400px;height:400px;"></iframe>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="certificategenerator/FileSaver.js"></script>
        <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>
    <script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4"></script>

    <script>
        const submitButton = document.getElementById("certification");
        const certi = document.querySelector("#mypdf"); 
        submitButton.onclick=(e)=>{
            e.preventDefault();
        const val = "Aditya Mishra";
        const formattedId="112211";
        generatePdf(val, formattedId);
        // submitButton.disabled = true;
        }
    </script>
</body>

</html>