<?php
include '../../_dbconnect.php';
$query = "SELECT DISTINCT year, batch FROM adminusers";
$result = mysqli_query($conn, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
