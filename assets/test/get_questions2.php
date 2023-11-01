<?php
include '../_dbconnect.php';

$query = "SELECT * FROM questions";
$result = $conn->query($query);

$questions = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

echo json_encode($questions);

$conn->close();
?>
