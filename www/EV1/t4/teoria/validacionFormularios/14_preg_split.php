<?php

$fecha = "1970-01-01 00:00:00";
// Como secuencia especial empleamos \s para referirnos a cualquier espacio
$patron = "/[-\s:]/";
$componentes = preg_split($patron, $fecha);
//preg_split ( string $pattern , string $subject [, int $limit = -1 [, int $flags = 0 ]] ) : array
echo "Recorremos la cadena:<br>";
foreach ($componentes as $variable) {
    echo "$variable<br>";
}
?> 
