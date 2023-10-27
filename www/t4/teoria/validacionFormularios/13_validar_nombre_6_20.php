<?php

/*
 * Validación de un nombre que contenga ente 6 y 20 caracteres que sean letras y números
 */

function nombre_entre_6_20($nombre) {
    $error = false;
    if (empty($_POST['usuario'])) {
        $error = true;
    } else {
        $usuario = trim($_POST['usuario']);
        $regex = '/^[a-z0-9]{6,20}$/';
        if (!preg_match($regex, $usuario)) {
            $error = true;
        }
    }

    return $error;
}

$nombre = "Prince Michael 2";
echo "El nombre $nombre " . (nombre_entre_6_20($nombre) ? ' es correcto' : ' no es correcto');
?>