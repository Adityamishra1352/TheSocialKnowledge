<?php 
include '../../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="GET"){
    $test_id=$_GET['test_id'];
    $sql="UPDATE `test` SET `displayed` = '0' WHERE `test`.`test_id` = '$test_id'";
    $result=mysqli_query($conn, $sql);
    if($result){
        header('location:organiser.php');
        exit();
    }
}
?>