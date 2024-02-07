<?php

class Usuario
{

    public string $nombre = 'N/A';
    public int $edad = 0;

}

$usuario = new Usuario();
$empleado = new Usuario();
$nuevo = &$usuario;
$clonado = clone($nuevo);

var_dump($usuario == $empleado);    // true
var_dump($usuario === $empleado);   // false
var_dump($usuario === $nuevo);      //true
var_dump($clonado === $nuevo);      //false
var_dump($clonado == $nuevo);       //true
/*
* El operador idéntico === devuelve falso cuando compara objetos aumque tengan
* las mismas propiedades y valores en sus propiedades
*/