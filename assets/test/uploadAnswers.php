<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the question_id values as an array
    $question_ids = $_POST["question_id"];

    // Loop through the question_ids and their associated options
    foreach ($question_ids as $question_id) {
        $selected_option = $_POST["option"][$question_id];
        echo $selected_option;
        echo $question_id;
    }
}
?>
