<?php

function comprobar_sesion() {
    /*
     * Para comprobar que sólo pueden acceder a la aplicación los usuarios que hayan hecho login.
     * Se une a la sesión existente y comprueba que la variable $_SESSION['usuario'] exista.
     * Si no es así, indica que el usuario no ha hecho login correctamente y por tanto
     * lo redirige al formulario del login
     */
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php?redirigido=true");
    }
}
