<?php
include '../../_dbconnect.php'; 
$course_id=$_GET['course_id'];
$deleteSql="UPDATE `courses` SET `displayed` = '0' WHERE `course_id` = '$course_id'";
$result=mysqli_query($conn,$deleteSql);
if($result){
    $contentSql="UPDATE `course_content` SET `displayed`=0 WHERE `course_id`='$course_id'";
    $result=mysqli_query($conn,$contentSql);
header('location:admin.php?deleteCourse=ture');
}
?>