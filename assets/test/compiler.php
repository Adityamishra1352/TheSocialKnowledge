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
// $output=null;
if ($language == "php") {
    if (isset($_POST['input'])) {
        $input = $_POST['input'];
        $inputFilePath = "temporary/" . "input_" . $random . ".txt";
        $outputFilePath = "temporary/" . "output_" . $random . ".txt";
        file_put_contents($inputFilePath, $input);
        $command = "C:\php\php.exe $filePath < $inputFilePath > $outputFilePath";
        shell_exec($command);
        $output = file_get_contents($outputFilePath);
        echo $output;
        $programFile = fopen($filePath, "a+");
        $existingCode = fread($programFile, filesize($filePath));
        $updatedCode = $existingCode . "\n\n// Input by user: $input";
        ftruncate($programFile, 0);
        fseek($programFile, 0);
        fwrite($programFile, $updatedCode);
        fclose($programFile);
        unlink($inputFilePath);
        unlink($outputFilePath);
    } else {
        $output = shell_exec("C:\php\php.exe $filePath 2>&1");
        echo $output;
    }
    if (strpos($output, 'error') !== false || strpos($output, 'warning') !== false) {
        unlink($filePath);
    }
} else if ($language == "c" || $language == "cpp") {
    $output = shell_exec("C:\TDM-GCC-64\bin\cpp.exe $filePath 2>&1");
    if (strpos($output, 'error') !== false || strpos($output, 'warning') !== false) {
        unlink($filePath);
    }

    echo $output;
} else if ($language == "nodejs") {
    rename($filePath, $filePath . ".js");
    $output = shell_exec("node $filePath.js 2>&1");
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