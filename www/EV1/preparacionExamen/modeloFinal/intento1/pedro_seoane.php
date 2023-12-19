<?php
declare(strict_types=1);

// LOCAL Types

require "utils.php";

// LOCAL Functions


// Main Loop

initSession();

// Endpoints
if (isset($_POST['reset'])) {
    session_destroy();
    initSession();
} elseif (isset($_POST['print'])) {
    error_log("SESSION: " . var_dump($_SESSION));
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examen</title>
    <meta author="Pedro Seoane">
</head>
<body>

<h1>Examen</h1>
<h2>LOGIN</h2>
<form method="post" action="login.php">
    <label for="loginEmail">Email</label>
    <input type="email" name="loginEmail" id="loginEmail">
    <br>
    <label for="loginPassword">Password</label>
    <input type="password" name="loginPassword" id="loginPassword">
    <br>
    <input type="submit" value="Login">
</form>

<h3>REGISTER</h3>
<form method="post" action="register.php">
    <label for="regEmail">Email</label>
    <input type="email" name="regEmail" id="regEmail">
    <br>
    <label for="regPassword">Password</label>
    <input type="password" name="regPassword" id="regPassword">
    <br>
    <label for="regPasswordVal">Repeat Password</label>
    <input type="password" name="regPasswordVal" id="regPasswordVal">
    <br>
    <input type="submit" value="Register">
</form>

<h3>RESET SESSION</h3>
<form method="post" action=<?php normaliceFormField($_SERVER['PHP_SELF']) ?>>
    <input type="submit" name="reset" value="Reset">
</form>

<h4>PRINT SESSION</h4>
<form method="post" action=<?php normaliceFormField($_SERVER['PHP_SELF']) ?>>
    <input type="submit" name="print" value="Print">
</form>


</body>
</html>