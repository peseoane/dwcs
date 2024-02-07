<?php
function mi_autocargador($clase) {
    $fichero = __DIR__ . "\\Clases\\" . $clase . '.php';
    if (file_exists($fichero))
        include $fichero;
    else
        include __DIR__ . "\\" . $clase . '.php';
}

spl_autoload_register("mi_autocargador");
