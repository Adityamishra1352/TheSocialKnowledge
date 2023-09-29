<?php
include '../_dbconnect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $certificate_id = $_GET['certificate_id'];
    $user_id = $_SESSION['user_id'];
    $certificateFormating = null;
    $certificate_sql = "SELECT * FROM `certificates` WHERE `certificate_id`='$certificate_id'";
    $certificate_result = mysqli_query($conn, $certificate_sql);
    while ($rowCertificate = mysqli_fetch_assoc($certificate_result)) {
        $certificateFormating = $rowCertificate['certificate_formating'];
    }
    $fname = null;
    $lname = null;
    $user_sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
    $user_result = mysqli_query($conn, $user_sql);
    while ($rowUser = mysqli_fetch_assoc($user_result)) {
        $fname = $rowUser['fname'];
        $lname = $rowUser['lname'];
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="../test/certificategenerator/certificate-gen.js"></script>
    <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>
    <script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">The Social Knowledge</a>
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
            </div>
        </div>
    </nav>
    <div class="container my-2 p-2 certificate_box" style="height:max-content">
        <center><iframe src="" id="certificatepdf" frameborder="0" style="width:400px;height:400px;overflow:hidden;"></iframe></center>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        let fname = "<?php echo $fname; ?>";
        let lname = "<?php echo $lname; ?>";
        let certificateFormating = "<?php echo $certificateFormating ?>";
        let name=fname+" "+lname;
        generatePdf(name, certificateFormating);
    </script>
</body>

</html>