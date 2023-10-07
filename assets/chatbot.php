<?php
include '_dbconnect.php'; 
if($_SERVER['REQUEST_METHOD']=="POST"){
    $location=$_POST['location'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $description=$_POST['query'];
    $sql="INSERT INTO `chatbot`(`name`,`email`,`description`)VALUE('$name','$email','$description')";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location:'.$location.'?chat=true');
    }
}
?>