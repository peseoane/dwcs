<?php
/*
 * Cierra la sesión y lleva a la página de login
 */
require_once 'sesiones.php';
comprobar_sesion();
$_SESSION=array(); //Destruye las variables de sesión
session_destroy(); // Eliminaa la sesion
setcookie(session_name(), 123, time() - 1000); // Elimina la cookie de sesión
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Sesión cerrada</title>
    </head>
    <body>
        <p>La sesión se cerró correctamente, hasta la próxima</p>
        <a href = "login.php">Ir a la página de login</a>
    </body>
</html>
