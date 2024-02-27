<?php

function mi_autocargador($clase) {
    //Esta primera línea hay que incluirla porque el namespace puede ser compuesto
    //y por tanto llevar \ o / y así lo indipendizamos del Sistema operativo
    $clase = str_replace('\\', DIRECTORY_SEPARATOR, $clase);
    $fichero = __DIR__ . DIRECTORY_SEPARATOR . "Clases" . DIRECTORY_SEPARATOR . $clase . '.php';
    if (file_exists($fichero))
        include $fichero;
    else
        include __DIR__ . "\\" . $clase . '.php';
}

spl_autoload_register("mi_autocargador");
