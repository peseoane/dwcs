<?php
declare(strict_types=1);
session_start();

require './Utils.php';

$dummyData = generarDatosDummy(1);
echo "<h6> ARRAY SIN ACTUALIZAR </h6>";
var_dump($dummyData);
// Si no existe esa canitdad dará falso si no nos devolverá un CLONADO MUTADO del array con ese campo actualizado.
echo "<h6> ARRAY ACTUALIZADO UN CAMPO SI HAY POSITIVO </h6>";
var_dump(checkForItem($dummyData, 100, 2));
$_SESSION['inventario'] = $dummyData;
// MAIN {LOOP}
echo "<h6> ESTADO DE LA SESION </h6>";
var_dump($_SESSION);

if (isset($_POST['reset'])) {
    session_destroy();
    $_SESSION['intentos'] = 0;
    header("Location: index.php");
}

?>

<<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PEDRO SEOANE PRADO</title>
</head>
<body>

<h2>LOGIN</h2>

<form method="POST" action='login.php'>
    <label for="loginEmail">login email</label>
    <input name="loginEmail" id="loginEmail" type="email" required>
    <br>
    <label for="loginPassword">login password</label>
    <input name="loginPassword" id="loginEmail" type="password" required>
    <br>
    <input name="login" type="submit">
</form>

<h2>SIGN UP // REGISTRATION</h2>

<form method="POST" action="register.php"
">
<label for="regEmail">login email</label>
<input name="regEmail" id="regEmail" type="email" required>
<br>
<label for="regPassword">login passsword</label>
<input name="regPassword" id="regPassword" type="password" required>
<br>
<label for="regPasswordRep">login password</label>
<input name="regPasswordRep" id="regPasswordRep" type="password" required>
<br>
<input name="registro" type="submit">
</form>

<h3>REINICIAR SESION</h3>
<p>Quitar bloqueo</p>
<form method="post">
    <input name="reset" type="submit">
</form>
</body>
</html>