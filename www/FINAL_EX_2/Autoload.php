<?php
declare(strict_types=1);
function main_autoload($clase): void
{
    $clase = str_replace('\\', DIRECTORY_SEPARATOR, $clase);
    $fichero = __DIR__ . DIRECTORY_SEPARATOR . 'Clases' . DIRECTORY_SEPARATOR . $clase . '.php';

    if (file_exists($fichero)) {
        include $fichero;
    } else {
        include __DIR__ . DIRECTORY_SEPARATOR . $clase . '.php';
    }
}

spl_autoload_register('main_autoload');