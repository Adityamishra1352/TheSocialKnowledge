<?php
session_start();
include '../../_dbconnect.php';
if (!(isset($_SESSION['admin']) || $_SESSION['admin'] != true)) {
    header('location: ../../403.php');
}
$course_id = $_GET['course_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="courseTest.php?course_id=<?php echo $course_id;?>">Test For this Course</a>
                    </li>
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-2 p-1">
        <ul>
            <li>
                <h4>Edit Content:</h4>
            </li>
        </ul>
        <div class="changethequestions_box p-2">
            <div id="questions-form">
                <label for="num-questions" id="noofquestionslabel">How many pages do you want in this course?</label><br><br>
                <input type="number" id="num-questions" name="num-questions" min="1" max="25" required
                    style="width: 20%;" class="form-control p-1"><br><br>
                <button type="submit" id="questionsSubmit" class="btn btn-primary mb-2">Submit</button><br>
            </div>
            <form action="addContent.php" method="post" id="questionsDynamic">
                <div class="inputContent p-1" style="width:40%;"></div>
                <input type="hidden" name="test_id" value="<?php echo $course_id ?>">
                <button id="addquestion" class="btn btn-outline-success my-2">Add Content</button>
            </form>
        </div>
    </div>
    <div class="container my-2">
        <ul>
            <li>
                <h4>Present Content:</h4>
            </li>
        </ul>
        <table class="table my-2" id="mytable">
            <thead>
                <tr>
                    <th scope="col">Page ID</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Description</th>
                    <th scope="col">Page Number</th>
                    <th scope="col">Nav Content</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql="SELECT * FROM `course_content` WHERE `course_id`='$course_id'";
                $result=mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <th scope='row'>".$row['page_id']."</th>
                    <td>".$row['heading']."</td>
                    <td>".$row['description']."</td>
                    <td>".$row['page_no']."</td>
                    <td>".$row['nav_content']."</td>
                    <td><button class='delete btn btn-sm btn-outline-danger' id=d".$row['page_id']." onclick='window.location.href=(`deleteContent.php?page_id=".$row['page_id']."&course_id=".$course_id."`)'>Delete</button></td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        const add_btn = document.querySelector("#questionsSubmit");
const form = document.querySelector(".inputContent");
add_btn.onclick = (e) => {
    e.preventDefault();
    const numQuestions = document.getElementById("num-questions").value;
    const mainContainer = document.createElement("div");
    const lineBreak = document.createElement("br");
    
    for (let i = 1; i <= numQuestions; i++) {
        const contentContainer = document.createElement("div");

        // Heading Input
        const headingLabel = document.createElement("label");
        headingLabel.style="width:100%;";
        const headingInput = document.createElement("input");
        headingInput.type = "text";
        headingInput.className = "form-control my-2 mr-2 p-1";
        headingInput.name = `heading-${i}`;
        headingInput.placeholder = `Heading, Page Number ${i}`;
        headingInput.style="width:100%;";
        headingLabel.appendChild(headingInput);
        contentContainer.appendChild(headingLabel);

        // Description Input
        const descriptionContainer = document.createElement("div");
        const descriptionInput = document.createElement("textarea");
        descriptionInput.placeholder = `Enter the content for Page Number: ${i}`;
        descriptionInput.classList="form-control p-1";
        descriptionInput.name = `description-${i}`;
        descriptionInput.style="width:100%";
        descriptionContainer.appendChild(descriptionInput);
        contentContainer.appendChild(descriptionContainer);

        // Page Number Input (hidden)
        const pageNumber = document.createElement("input");
        pageNumber.value=i;
        pageNumber.type = "hidden";
        pageNumber.name = `pagenumber-${i}`;
        contentContainer.appendChild(pageNumber);
        
        //Nav Input
        const navContainer=document.createElement("div");
        const navInput=document.createElement("input");
        navInput.placeholder=`Enter the Navbar heading for Page:${i}`;
        navInput.classList="form-control p-1 my-2";
        navInput.name=`nav-${i}`;
        navInput.style="width:100%";
        navContainer.appendChild(navInput);
        contentContainer.appendChild(navContainer);
        mainContainer.appendChild(contentContainer);
    }

    form.appendChild(mainContainer);
    document.getElementById("questionsSubmit").disabled = true;
};

let table = new DataTable('#myTable');

    </script>
</body>

</html>