<?php 
include 'assets/_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $likedWebsite=$_POST['likedWebsite'];
    $forRecommendations=$_POST['forRecommendations'];
    // echo $likedWebsite;
    // echo $forRecommendations;
    $sql="INSERT INTO `feedback` (`likewebsite`, `recommendations`, `timestamp`) VALUES ( '$likedWebsite', '$forRecommendations', current_timestamp());";
    $result=mysqli_query($conn,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Feedback</title>
    <link rel="stylesheet" href="assets/css/feedback.css">
</head>

<body>
    <div class="main_page">
        <form class="form_input" action="feedback.php" method="post">
            <div class="heading">
                <h1>The Social Knowledge: Feedback</h1>
            </div>
            <div class="content">
                <h1>Did you like the website?</h1>
                <select id="likedWebsite" name="likedWebsite">
                    <option value="Yes">Yes</option>
                    <option value="Partially">Partially</option>
                    <option value="No">No</option>
                </select>
                <h1>Do you have any recomendations?</h1>
                <textarea id="forRecomendations" cols="30" rows="10" name="forRecommendations"></textarea><br>
                <button id="submit">Submit</button>
            </div>
            <footer>
                <h1>ThankYou for your visit!!</h1>
            </footer>
        </form>
    </div>
</body>

</html>