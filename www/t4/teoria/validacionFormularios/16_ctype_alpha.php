<?php

//    http://localhost/validacionFormularios/16_ctype_alpha.php?nombre=Patricia
//    http://localhost/validacionFormularios/16_ctype_alpha.php?nombre=Patricia25
//    http://localhost/validacionFormularios/16_ctype_alpha.php?nombre=Patricia%

$valido = array();
// comprueba el nombre
if (isset($_GET['nombre']) &&
        ctype_alpha($_GET['nombre'])) {
    $valido['nombre'] = trim($_GET['nombre']);
    echo $valido['nombre'] . " contiene sólo caracteres alfabéticos";
} else {
    die('ERROR: No se ha proporcionado el nombre o no es válido.');
}
?> 

