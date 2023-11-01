<?php
include '../../_dbconnect.php';

$question_idsUser = [];

$scoreSQL = "SELECT answers FROM `testscores` WHERE `test_id` = 19";
$scoreResult = mysqli_query($conn, $scoreSQL);

while ($scoreRow = mysqli_fetch_array($scoreResult)) {
    $answers = json_decode($scoreRow["answers"], true);
    
    foreach ($answers as $answer) {
        // Check if 'question_id' exists in this answer element
        if (isset($answer['question_id'])) {
            $question_idsUser[] = $answer['question_id'];
        }
    }
}

// Initialize the attempts count for each question
$attempts = [];

// Step 1: Retrieve data from the database
$sql = "SELECT question_id FROM questions WHERE test_id = 19"; // Replace '1' with the actual test_id
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $questionId = $row['question_id'];
    $attempts[$questionId] = 0; // Initialize attempts count to 0 for each question
}

// Count the attempts for each question
foreach ($question_idsUser as $userQuestion) {
    if (isset($attempts[$userQuestion])) {
        $attempts[$userQuestion]++;
    }
}

$questionLabels = [];
$attemptCounts = [];
foreach ($attempts as $questionId => $count) {
    $sql = "SELECT question FROM questions WHERE question_id = $questionId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $questionLabels[] = $row['question'];
    $attemptCounts[] = $count;
}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Step 3: Create a pie chart using Chart.js -->
    <div>
        <canvas id="myPieChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($questionLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($attemptCounts); ?>,
                    backgroundColor: [
                        'red',
                        'blue',
                        'green',
                        'orange',
                        'purple',
                        // Add more colors as needed
                    ],
                }],
            },
        });
    </script>
</body>
</html>
