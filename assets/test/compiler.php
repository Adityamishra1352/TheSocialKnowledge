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
        $inputLines = implode("\n", explode(",", $input)) . "\n";
        $inputFilePath = "temporary/" . "input_" . $random . ".txt";
        $outputFilePath = "temporary/" . "output_" . $random . ".txt";
        file_put_contents($inputFilePath, $inputLines);
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
    unlink($filePath);
}
if ($language == "c" || $language == "cpp") {
    if (isset($_POST['input'])) {
        $random = uniqid();
        $input = implode("\n", explode(",", $_POST["input"])) . "\n";
        $inputFilePath = "temporary/input_" . $random . ".txt";
        $outputFilePath = "temporary/output_" . $random . ".txt";
        file_put_contents($inputFilePath, $input);
        $command = "C:\\TDM-GCC-64\\bin\\gcc.exe $filePath -o program.exe 2>&1";
        exec($command, $outputCompile, $returnCode);

        if ($returnCode === 0) {
            $command = "program.exe < $inputFilePath > $outputFilePath 2>&1";
            exec($command, $outputExecute, $returnCode);

            if ($returnCode === 0) {
                $programOutput = file_get_contents($outputFilePath);
                echo $programOutput;
            } else {
                echo "Execution error:<br>";
                echo implode("\n", $outputExecute);
            }
        } else {
            echo "Compilation error:<br>";
            echo implode("\n", $outputCompile);
        }
        unlink($inputFilePath);
        unlink($outputFilePath);
    } else {
        $command = "C:\\TDM-GCC-64\\bin\\gcc.exe $filePath -o program.exe 2>&1";
        exec($command, $outputCompile, $returnCode);

        if ($returnCode === 0) {
            $programOutput = shell_exec("program.exe 2>&1");
            echo $programOutput;
        } else {
            echo "Compilation error:<br>";
            echo implode("\n", $outputCompile);
        }
    }
    unlink($filePath);
} else if ($language == "py") {
    if (isset($_POST['input'])) {
        $input = implode("\n", explode(",", $_POST["input"])) . "\n";
        $inputFilePath = "temporary/" . "input_" . $random . ".txt";
        $outputFilePath = "temporary/" . "output_" . $random . ".txt";
        file_put_contents($inputFilePath, $input);
        $command = "C:\Users\mishr\AppData\Local\Programs\Python\Python312\python.exe $filePath < $inputFilePath > $outputFilePath";
        shell_exec($command);
        $output = file_get_contents($outputFilePath);
        echo $output;
        unlink($inputFilePath);
        unlink($outputFilePath);
    } else {
        $output = shell_exec("C:\Users\mishr\AppData\Local\Programs\Python\Python312\python.exe $filePath 2>&1");
        echo $output;
        unlink($filePath);
    }
} else if ($language == "java") {
    if (isset($_POST["input"])) {
        $className = "Main";
        preg_match('/\bclass\s+(\w+)/', $code, $matches);
        $className = isset($matches[1]) ? $matches[1] : "Main";
        $userDirectory = "answers/" . $user_id . "/";
        if (!is_dir($userDirectory)) {
            mkdir($userDirectory, 0755, true);
        }
        $inputs = explode(",", $_POST['input']);
        $formattedInputs = implode("\n", $inputs) . "\n";
        $inputFilePath = $userDirectory . "input_" . $random . ".txt";
        file_put_contents($inputFilePath, $formattedInputs);
        $newFilePath = $userDirectory . $className . ".java";
        rename($filePath, $newFilePath);
        $filePath = $newFilePath;
        $jdkBinPath = "\"C:\\Program Files\\Java\\jdk-17.0.2\\bin\"";
        $compileCommand = "$jdkBinPath\\javac \"$filePath\" 2>&1";
        exec($compileCommand, $compileOutput, $compileReturnCode);
        if ($compileReturnCode === 0) {
            $className = pathinfo($filePath, PATHINFO_FILENAME);
            $runCommand = "$jdkBinPath\\java -cp $userDirectory $className < $inputFilePath 2>&1";
            exec($runCommand, $runOutput, $runReturnCode);

            if ($runReturnCode === 0) {
                echo implode("\n", $runOutput);
            } else {
                echo "Execution error:<br>";
                echo implode("\n", $runOutput);
            }
        } else {
            echo "Compilation error:<br>";
            echo implode("\n", $compileOutput);
        }

        unlink($filePath);
        $classFilePath = $userDirectory . $className . ".class";
        unlink($classFilePath);
        unlink($inputFilePath);
        rmdir($userDirectory);
    } else {

        $className = "Main";
        preg_match('/\bclass\s+(\w+)/', $code, $matches);
        $className = isset($matches[1]) ? $matches[1] : "Main";
        $userDirectory = "answers/" . $user_id . "/";
        if (!is_dir($userDirectory)) {
            mkdir($userDirectory, 0755, true);
        }

        $newFilePath = $userDirectory . $className . ".java";
        rename($filePath, $newFilePath);
        $filePath = $newFilePath;
        $jdkBinPath = "\"C:\\Program Files\\Java\\jdk-17.0.2\\bin\"";
        $compileCommand = "$jdkBinPath\\javac \"$filePath\" 2>&1";
        exec($compileCommand, $compileOutput, $compileReturnCode);

        if ($compileReturnCode === 0) {
            $className = pathinfo($filePath, PATHINFO_FILENAME);
            $runCommand = "$jdkBinPath\\java -cp answers \"$filePath\" 2>&1";
            exec($runCommand, $runOutput, $runReturnCode);

            if ($runReturnCode === 0) {
                echo implode("\n", $runOutput);
            } else {
                echo "Execution error:<br>";
                echo implode("\n", $runOutput);
            }
        } else {
            echo "Compilation error:<br>";
            echo implode("\n", $compileOutput);
        }
        unlink($filePath);
        $classFilePath = $userDirectory . $className . ".class";
        unlink($classFilePath);
        // Remove the entire user directory
        if (is_dir($userDirectory)) {
            rmdir($userDirectory);
        }
    }
}else if ($language == "sql") {
    $tempDbFile = 'answers/'.$user_id.'tempDatabase.sqlite';
    try {
        $db = new PDO('sqlite:' . $tempDbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlQueries = explode(';', $_POST['code']);

        foreach ($sqlQueries as $sqlQuery) {
            if (trim($sqlQuery) == '') {
                continue;
            }

            $stmt = $db->prepare($sqlQuery);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                echo '<table class="table table-hover" id="sqlTable">';
                echo '<tr>';
                foreach ($result[0] as $column => $value) {
                    echo '<th>' . htmlspecialchars($column) . '</th>';
                }
                echo '</tr>';
                foreach ($result as $row) {
                    echo '<tr>';
                    foreach ($row as $value) {
                        echo '<td>' . htmlspecialchars($value) . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                // echo 'Query executed successfully.<br>';
            }
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    unlink($filePath);
}

// $directory = "answers/";
// $twoDaysAgo = time() - (2 * 24 * 60 * 60);

// foreach (scandir($directory) as $file) {
//     $filePath = $directory . $file;

//     if (is_file($filePath) && filemtime($filePath) < $twoDaysAgo) {
//         unlink($filePath);
//     }
// }
?>