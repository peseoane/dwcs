<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $uploadedFiles = $_FILES["file"];
    $varDumpResults = [];

    foreach ($uploadedFiles["name"] as $key => $fileName) {
        $varDumpResult = processUploadedFile($uploadedFiles, $key);
        $varDumpResults[] = generateResultCard($varDumpResult);
    }

    echo implode("", $varDumpResults);
} else {
    echo generateResultCard("ERROR: No se ha proporcionado ningún archivo.");
}

function processUploadedFile($uploadedFiles, $key)
{
    if ($uploadedFiles["error"][$key] === UPLOAD_ERR_OK) {
        ob_start();
        var_dump($uploadedFiles);
        return ob_get_clean();
    } else {
        return "ERROR: " . $uploadedFiles["error"][$key];
    }
}

function generateResultCard($varDumpResult)
{
    return '<div class="card text-bold">' . $varDumpResult . "</div>";
}
?>
