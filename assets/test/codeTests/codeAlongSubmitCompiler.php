<?php
session_start();
$user_id = $_SESSION['user_id'];
$language = strtolower($_POST['language']);
$code = $_POST['code'];
$test_id=$_POST['test_id'];
$question_id = $_POST['question_id'];
include '../../_dbconnect.php';
$testCases_sql = "SELECT * FROM `codingquestions` WHERE `code_id`='$question_id'";
$testCasesResult = mysqli_query($conn, $testCases_sql);
$testCasesRow = mysqli_fetch_assoc($testCasesResult);
$testCases = $testCasesRow["inputOutput"];
$testCasesarray = json_decode($testCases, true);
$random = substr(md5(mt_rand()), 0, 7);
$filePath = "answers/" . $user_id. $question_id . $random . "." . $language;
$programFile = fopen($filePath, "w");
fwrite($programFile, $code);
fclose($programFile);
if ($language == "php") {
    $isCorrect = true;
    $filenameArray[] = $filePath;
    foreach ($testCasesarray as $testCase) {
        $input = implode("\n", explode(",", $testCase["input"])) . "\n";
        $expected_output = implode("\n", explode(",", $testCase["expected_output"]));
        $inputFilePath = "input_" . $random . ".txt";
        $outputFilePath = "output_" . $random . ".txt";
        file_put_contents($inputFilePath, $input);
        $command = "C:\php\php.exe $filePath < $inputFilePath > $outputFilePath";
        shell_exec($command);
        $actual_output = file_get_contents($outputFilePath);
        if (trim($actual_output) != trim($expected_output)) {
            $isCorrect = false;
            break;
        }
        unlink($inputFilePath);
        unlink($outputFilePath);
    }
    if($isCorrect){
        echo "yeah";
    }
    else{
        echo "oops";
    }
    $selectSql = "SELECT * FROM `codinganswers` WHERE `user_id`='$user_id' AND `test_id`='$test_id'";
    $selectResult = mysqli_query($conn, $selectSql);
    
    if (mysqli_num_rows($selectResult) > 0) {
        $rowCode=mysqli_fetch_assoc($selectResult);
        $existingFilenames = json_decode($rowCode["filename"], true);
        $filenameArray = array_merge($existingFilenames, $filenameArray);
        $userScore=$rowCode["correct"];
        if ($isCorrect) {
            $userScore+=1;
        }
        $updateScore = "UPDATE `codinganswers` SET `filename`='" . json_encode($filenameArray) . "', `correct`='$userScore' WHERE `user_id`='$user_id' AND `test_id`='$test_id'";
        $updateResult = mysqli_query($conn, $updateScore);
    } else {
        // Insert a new row with the filenames and initial score
        $updateScore = "INSERT INTO `codinganswers`(`question_id`,`filename`,`user_id`,`correct`,`test_id`) VALUES('$question_id','" . json_encode($filenameArray) . "','$user_id','$isCorrect','$test_id')";
        $updateResult = mysqli_query($conn, $updateScore);
    }
} else if ($language == "c" || $language == "cpp") {
    $output = shell_exec("C:\TDM-GCC-64\bin\gcc.exe $filePath 2>&1");
    if (strpos($output, 'error') !== false || strpos($output, 'warning') !== false) {
        unlink($filePath);
    }

    echo $output;
} else if ($language == "nodejs") {
    rename($filePath, $filePath . ".js");
    $output = shell_exec("C:\Program Files (x86)\nodejs\node.exe $filePath 2>&1");
    echo $output;
    if (strpos($output, 'error') !== false || strpos($output, 'warning') !== false) {
        unlink($filePath . ".js");
    }
}

$directory = "answers/";
$twoDaysAgo = time() - (2 * 24 * 60 * 60);

foreach (scandir($directory) as $file) {
    $filePath = $directory . $file;

    if (is_file($filePath) && filemtime($filePath) < $twoDaysAgo) {
        unlink($filePath);
    }
}
?>