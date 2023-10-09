<?php
session_start();
include '../../_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $page_id = $_GET['page_id'];
    $sql = "UPDATE `course_content` SET `displayed` = '0' WHERE `course_content`.`page_id` = '$page_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            header('location:editCourse.php?course_id='.$_GET['course_id'].'&deleteContent=true');
        } 
    }
}
?>