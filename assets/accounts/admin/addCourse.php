<?php
include '../../_dbconnect.php'; 
if($_SERVER['REQUEST_METHOD']="POST"){
    $course_name=$_POST['course_name'];
    $course_description=$_POST['course_description'];
    $sql="INSERT INTO `courses`(`heading`,`description`)VALUES('$course_name','$course_description')";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location:admin.php?addCourse=true');
    }
}
?>