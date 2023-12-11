<?php
declare(strict_types=1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cookieName = $_POST["cookieName"] ?? null;
    $cookieValue = $_POST["cookieValue"] ?? null;
    $cookieLifespan = !empty($_POST["cookieLifespan"])
        ? $_POST["cookieLifespan"]
        : 30;

    if (
        !empty($cookieName) &&
        !empty($cookieValue) &&
        !empty($cookieLifespan)
    ) {
        $expiration = time() + (int) $cookieLifespan;
        setcookie($cookieName, $cookieValue, $expiration);
        header("Location: practica1.php");
        exit();
    }

    if (isset($_POST["deleteCookies"])) {
        foreach ($_COOKIE as $name => $value) {
            setcookie($name, "", time() - 3600);
        }
        header("Location: practica1.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookie Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<body class="container p-4">
<h1>Cookie Manager</h1>

<h2>Current Cookies</h2>
<ul>
    <?php foreach ($_COOKIE as $name => $value) {
        echo "<li>" .
            htmlspecialchars($name) .
            ": " .
            htmlspecialchars($value) .
            "</li>";
    } ?>
</ul>

<h2>Add a New Cookie</h2>
<form method="post" action="">
    <label>
        Cookie Name:
        <input type="text" name="cookieName" required>
    </label>
    <label>
        Cookie Value:
        <input type="text" name="cookieValue" required>
    </label>
    <label>
        Cookie Lifespan (in seconds):
        <input type="number" name="cookieLifespan">
    </label>
    <input type="submit" value="Add Cookie">
</form>

<h2>Delete All Cookies</h2>
<form method="post" action="">
    <input type="submit" name="deleteCookies" value="Delete All Cookies">
</form>
</body>
</html>