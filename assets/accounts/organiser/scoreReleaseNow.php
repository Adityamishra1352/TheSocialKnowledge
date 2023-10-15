<?php 
include '../../_dbconnect.php';
$test_id=$_POST['test_id'];
$update_sql="UPDATE `test` SET `scoreRelease`=1 WHERE `test_id`='$test_id'";
$update_result=mysqli_query($conn, $update_sql);
if($update_result){
    header('location:addQuestions.php?test_id='.$test_id.'&scoreRelease=true');
} 
else
{
    echo mysqli_connect_error();
}
?>