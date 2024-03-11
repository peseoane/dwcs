<?php
declare(strict_types=1);
spl_autoload_register(function ($clase) {
    $clase = str_replace('\\', DIRECTORY_SEPARATOR, $clase);

    $fichero = __DIR__ . DIRECTORY_SEPARATOR . "Clases" . DIRECTORY_SEPARATOR . $clase . '.php';

    if (file_exists($fichero)) {
        include $fichero;
    } else {
        include __DIR__ . DIRECTORY_SEPARATOR . $clase . '.php';
    }
});