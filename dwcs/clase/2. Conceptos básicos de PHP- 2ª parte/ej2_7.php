<?php
// Report all PHP errors
error_reporting(E_ALL);
echo gettype(5) . "<br>";   // salida: 'integer'
echo gettype('Sara') . "<br>";   // salida: 'string'
echo gettype(3.1416) . "<br>";  // salida: 'double'
unset($nombre);   // destruye la variable
echo gettype($nombre) . "<br>";  // salida: 'NULL'
echo gettype(NULL) . "<br>";  // salida: 'NULL'
echo gettype(new stdClass()) . "<br>";  // salida: 'object'

