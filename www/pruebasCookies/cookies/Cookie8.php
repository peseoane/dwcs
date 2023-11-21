<?php

/*
 * La primera vez que se ejecuta este script no vamos a visualizar nada porque
 * hacemos una petición al navegador que almacene la cookie. En la segunda vez,
 * si el navegador no tiene deshabilitadas las cookies, me las mostraría.
 */
setcookie('usuario[nombre]', 'Pepe');
setcookie('usuario[apellido1]', 'García');
setcookie('usuario[apellido2]', 'Fernández');

if (isset($_COOKIE['usuario'])) {
    foreach ($_COOKIE['usuario'] as $nombre => $valor) {
        echo "$nombre : $valor <br />";
    }
}
?>

