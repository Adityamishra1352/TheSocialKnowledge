<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_ids = $_POST["question_id"];
    foreach ($question_ids as $question_id) {
        $selected_option = $_POST["option"][$question_id];
        echo $selected_option;
        echo $question_id;
    }
}
?>
