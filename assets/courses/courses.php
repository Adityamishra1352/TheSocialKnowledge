<?php 
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: Courses</title>
    <link rel="stylesheet" href="../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../../index.php">The Social Knowledge</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../sorting_visualizer/index.php">Sorting Visualizer</a>
        </li>
        <!-- when logged in will show dashboard or signup login -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<div class="container mx-2" style="display:grid;grid-template-columns:1fr 1fr 1fr;">
  <?php 
  include '../_dbconnect.php';
  $course_sql="SELECT * FROM `courses` WHERE `displayed`=1";
  $course_result=mysqli_query($conn,$course_sql);
  while($rowCourse=mysqli_fetch_assoc($course_result)){
    $heading=$rowCourse['heading'];
    $description=$rowCourse['description'];
    $course_id=$rowCourse['course_id'];
    echo '<div class="card my-2" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">'.$heading.'</h5>
      <p class="card-text">'.$description.'</p>
      <a href="course.php?course_id='.$course_id.'&page_no=1" class="btn btn-primary">Start Course</a>
    </div></div>';
  }
  ?>
</div>
<script src="../modules/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>