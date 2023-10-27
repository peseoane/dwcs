<?php

//http://localhost/validacionFormularios/6_comprobar_fecha.php?fecha=31/01/2020
//http://localhost/validacionFormularios/6_comprobar_fecha.php?fecha=31/01/2020
$fecha = explode('/', $_GET['fecha'], 3);
//checkdate ( int $month , int $day , int $year ) : bool
//Primero va el mes, luego el día y después el año
if ((count($fecha) == 3) && checkdate($fecha[1], $fecha[0], $fecha[2])) {
    echo "El formato de " . $_GET['fecha'] . " es correcto";
} else {
    $error = true;
}
