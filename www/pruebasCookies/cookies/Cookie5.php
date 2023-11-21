<?php

/*
 * Para ejecutar este fichero borrar todas las cookies almacenadas en el navegador.
 * Ejecutarlo por primera vez y el mensaje de salida será Bienvenido nuevo usuario.
 * A continuación ejecutar el fichero Cookie2.php, el cual creará la cookie usuario
 * y volver a ejecutar este fichero. Veremos como esta vez el mensaje cambia
 */
if (isset($_COOKIE['usuario']))
    echo 'Hola de nuevo, ' . $_COOKIE['usuario'];
else
    echo 'Bienvenido nuevo usuario';
?> 

