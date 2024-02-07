<?php

//echo "Ver que namespace debe ser la primera línea de código descomentando esta línea";

/*
 * Salida: Fatal error: Namespace declaration statement has to be the very first statement in the script
 * La única construcción de código permitida antes de la declaración de un espacio 
 * de nombres es la sentencia declare.
 * Aunque cualquier código de PHP válido puede estar contenido dentro de un 
 * espacio de nombres, solamente se ven afectados por espacios de nombres los 
 * siguientes tipos de código: clases (incluyendo abstractas y traits), interfaces,
 * funciones y constantes. 
 */

namespace Lenguajes; //Indico que estoy en el namespace Lenguajes

include "25_namespace.php";

use Lenguajes\PHP\Prueba;

$prueba1 = new Prueba();           // Muestra "Prueba en Lenguajes PHP."
//Empleamos la palabra clave namespace para hacer referencia a los elementos del 
//espacio de nombres actual
$prueba2 = new namespace \Prueba(); // Muestra "Prueba en Lenguajes."

