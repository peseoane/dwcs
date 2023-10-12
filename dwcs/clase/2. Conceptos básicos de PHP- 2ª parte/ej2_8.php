<?php

// define variable real 
$velocidad = 501.789;  // ojo al punto decimal
// cast a tipo entero: vale (integer) o (int)
$nuevaVelocidad = (integer) $velocidad."<br>";  // trunca
echo $nuevaVelocidad;  // salida: 501
$aux="123abc.";
echo (integer)$aux;
?> 
