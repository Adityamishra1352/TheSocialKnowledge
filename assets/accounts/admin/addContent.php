<?php
include '../../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$content = [];
$test_id= $_POST['test_id'];
for ($i = 1; isset($_POST["heading-$i"]); $i++) {
    $questionObj = [];
    $questionObj['heading'] = $_POST["heading-$i"];
    $questionObj['pagenumber'] = $_POST["pagenumber-$i"];
    $questionObj['description'] = $_POST["description-$i"];
    $questionObj['nav'] = $_POST["nav-$i"];
    $content[] = $questionObj;
}
echo var_dump($content);
foreach ($content as $questionData) {
    
    $headingText = $questionData['heading'];
    $descriptionText=$questionData['description'];
    $navText=$questionData['nav'];
    $pagenumberText=$questionData['pagenumber'];
    $sql="INSERT INTO `course_content` (`heading`, `description`, `nav_content`, `course_id`, `page_no`) VALUES ('$headingText', '$descriptionText', '$navText', '$test_id', '$pagenumberText')";
    $result=mysqli_query($conn,$sql); 
    if($result){
        header('location:admin.php?courseEdit=true');
    }   
    else{
        echo mysqli_connect_error();
    }
}
}

?>
