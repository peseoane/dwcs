<?php

$cook = setcookie("nuevaCookie", "nuevo valor", time() + 3000, "/ruta", "midominio.com", true);
if ($cook)
    echo "La petición de la creación de la cookie se envió con éxito";

/*
 * El 6º parámetro: secure. Indica que la cookie debería ser sólo transmitida sobre
 * una conexión segura HTTPS desde el cliente, por lo que sólo se transmite si 
 * existe una conexión segura.
 */

