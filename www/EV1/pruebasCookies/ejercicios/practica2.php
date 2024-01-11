<?php
declare(strict_types=1);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $textValue = $_POST["textValue"] ?? null;
}

if (isset($_POST["deleteSession"])) {
    session_destroy();
    header("Location: assignment-2.php");
    exit();
}

if (!empty($textValue)) {
    if (isset($_SESSION["textValue"]) && is_array($_SESSION["textValue"])) {
        $_SESSION["textValue"][] = $textValue;
    } else {
        $_SESSION["textValue"] = [$textValue];
    }
    header("Location: assignment-2.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookie Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <script>
        window.onload = function () {
            const link = document.querySelector('link[href="../../css/bootstrap.css"]');
            const request = new XMLHttpRequest();
            request.open('GET', link.href, true);
            request.onreadystatechange = function () {
                if (request.readyState === 4) {
                    if (request.status === 404) {
                        link.href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css";
                    }
                }
            };
            request.send();
        }
    </script>
</head>
<body class="container p-4">
<h1>Cookie Manager</h1>

<h2>Current Cookies</h2>
<pre>
    <?php var_dump($_SESSION); ?>
</pre>

<h2>Add new data to the session</h2>
<form method="post" action="">
    <label>
        Text value:
        <input type="text" name="textValue" required>
    </label>
    <input type="submit" value="Add text">
</form>
<h3>Delete session</h3>
<form method="post" action="">
    <input type="submit" name="deleteSession" value="Delete session">
</form>
</body>
</html>