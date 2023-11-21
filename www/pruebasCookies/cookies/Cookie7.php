<?php
/* Si indicamos un tiempo de expiración restanto algo al tiempo actual, la cookie
 * se elimina automáticamente, aunque los más sencillo sería escribir 
 * setcookie('usuario', 'Patricia', 1);
 * 
 * Si ejecutamos este fichero en un entorno libre de cookies (es decir, que en 
 * el que no se haya creado anteriormente como en Cookie2.php), nunca llegaremos a ver 
 * la cookie. El tiempo de expiración es inferior al actual y por tanto "la crea 
 * en un tiempo pasado"
 */
$r = setcookie('usuario', 'Patricia', time() - 5000);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Eliminación de cookies</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><head>
    <body>
        <?php
        if ($r)
            echo 'Cabeceras de cookie transmitidas';
        ?>
    </body>
</html> 


