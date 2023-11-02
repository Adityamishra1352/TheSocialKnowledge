<?php
session_start();
$user_id = $_SESSION['user_id'];
$language = strtolower($_POST['language']);
$code = $_POST['code'];
$random = substr(md5(mt_rand()), 0, 7);
$filePath = "answers/" . $user_id . $language . $random . "." . $language;
$programFile = fopen($filePath, "w");
fwrite($programFile, $code);
fclose($programFile);

if ($language == "php") {
    if(isset($_POST['input'])){
        $input = $_POST['input'];
        $expected_output = implode("\n", $testCase["expected_output"]);

        $inputFilePath = "input_" . $random . ".txt";
        $outputFilePath = "output_" . $random . ".txt";
        file_put_contents($inputFilePath, $input);
        $command = "C:\php\php.exe $filePath < $inputFilePath > $outputFilePath";
        shell_exec($command);
        $actual_output = file_get_contents($outputFilePath);
        echo $actual_output;
        unlink($inputFilePath);
        unlink($outputFilePath);
    }
    else{
        $output = shell_exec("C:\php\php.exe $filePath 2>&1");
    }
    if (strpos($output, 'error') !== false || strpos($output, 'warning') !== false) {
        unlink($filePath);
    }
    echo $output;
} else if ($language == "c" || $language == "cpp") {
    $output = shell_exec("");
    if (strpos($output, 'error') !== false || strpos($output, 'warning') !== false) {
        unlink($filePath);
    }

    echo $output;
} else if ($language == "nodejs") {
    rename($filePath, $filePath . ".js");
    $output = shell_exec("node $filePath.js 2>&1");
    if (strpos($output, 'error') !== false || strpos($output, 'warning') !== false) {
        unlink($filePath . ".js");
    }
    echo $output;
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