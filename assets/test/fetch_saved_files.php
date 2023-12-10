<?php
session_start();
$user_id=$_SESSION['user_id'];
include '../_dbconnect.php';
$countValues = 0;
$sql = "SELECT * FROM `savedFiles` WHERE `user_id`='$user_id'";
$result = mysqli_query($conn, $sql);
$basePath = "answers";
while ($row = mysqli_fetch_assoc($result)) {
    $countValues += 1;
    $filename = $row['filename'];
    $language = $row['language'];
    $time = $row['date'];
    $timestamp = strtotime($time);
    $formattedDate = date('d F Y', $timestamp);
    $formattedTime = date('H:i', $timestamp);
    $filePath = $basePath . '/' . $filename;
    $fileContent = file_get_contents($filePath);
    $previewContent = substr($fileContent, 0, 150);
    $downloadLink = $filePath;
    echo '<div class="col"><div class="card p-2" style="width: 18rem;">
            <pre class="card-text">' . htmlspecialchars($previewContent) . '</pre>
            <div class="card-body">
            <h5 class="card-title">Language: ' . $language . '</h5>
            <p class="card-text text-secondary">Saved On: ' . $formattedTime . ', ' . $formattedDate . '</p>
            <a href="" class="btn btn-primary" download>Load File</a>
            </div>
            </div></div>';
}
if ($countValues == 0) {
    echo '<div class="card" style="width:40%">
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p>You have not saved any codes.</p>
                    <footer class="blockquote-footer"><cite title="Source Title">The Social Knowledge</cite></footer>
                    </blockquote>
                    </div>
                    </div>';
}
?>