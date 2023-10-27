<?php

/*
 * Ejecutar el fichero directamente o utilizando la url proporcionada, para ver
 * que realmente es necesario enviar el parámetro por http.
 * Notar que en Xdebug siempre aparecerá el nombre
 */
//http://localhost/validacionFormularios/5_filter_has_var.php?nombre='Patricia González'
$_GET['nombre'] = 'Patricia';

/*
 * filter_has_var ( int $type , string $variable_name ) : bool
 * Comprueba si la variable del tipo especificado existe
 * type-> Uno de los siguientes valores INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENV.
 */
echo filter_has_var(INPUT_GET, 'nombre') ? 'Hemos' : 'No hemos';
echo " recibido como dato el nombre.";
?>
