<?php
include '../../_dbconnect.php';

if (isset($_POST['year']) && isset($_POST['batch'])) {
    $year = $_POST['year'];
    $batch = $_POST['batch'];
    $sql = "SELECT * FROM adminusers WHERE year = '$year' AND batch = '$batch'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<th>' . $count . '</th>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['enrollment'] . '</td>';
            echo '<td><input class="form-check-input" type="checkbox" name="selectedUser[]" value="' . $row['sno'] . '"></td>';
            echo '</tr>';
            $count++;
        }
    } else {
        echo '<tr><td colspan="4">No users found for the selected filters.</td></tr>';
    }
} else {
    echo '<tr><td colspan="4">Invalid request.</td></tr>';
}
?>
