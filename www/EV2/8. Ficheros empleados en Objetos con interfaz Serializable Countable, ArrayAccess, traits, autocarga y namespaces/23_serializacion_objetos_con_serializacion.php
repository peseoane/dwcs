<?php
echo phpinfo();
/*
 * Ejemplo de serialización de un objeto Profesor, que contiene un array de objetos
 * bailes. Incluye herencia, namespaces, autocarga, traits, utilización de las interfaces 
 * ArrayAccess y Countable
 */
include "autoload.php";

use \Persona\Profesor as teacher;
use \Persona\Alumno as student;

$profe = new teacher("Patricia", "González", 619111111, "123456789-B");
echo " y tiene " . $profe->count_apellidos() . " apellidos";
$profe->anhadeBaile("Salsa", 8);
//Este no lo va a introducir por estar repetido, aunque tenga diferente edad mínima
$profe->anhadeBaile("Salsa", 12);
$profe->anhadeBaile("Rock");

/*
 *  Creamos bailes usando la interfaz ArrayAccess implementada en la clase Profesor.
 *  Tal y como está implementada no se pueden crear objetos de tipo baile con 
 * dos parámetros, de ahí que hayamos creado la funcion anhadeBaile
 */
$profe[] = "Tango";
//Esta tampoco la introduce por estar repetida
$profe->offsetSet("", "Tango");

var_dump($profe);

echo "<br>Usando la interfaz Countable, puedo indicar el nº bailes que imparte el profesor, siendo " .
 $profe->count() . " bailes, con una duración total de " . $profe::duracion * $profe->count() . " minutos";

//sleep(5); //Pongo 5 segundos entre la creación de los dos usuarios para que se aprecie la diferencia
$alumno = new student("Diego", "Martín Ruíz", 620111111, 2);
echo " y tiene " . $alumno->count_apellidos() . " apellidos<br>";

echo '<br><br><b>INFORMACIÓN DEL PROFESOR</b><br>';
var_dump($profe);

echo '<br><br><b>INFORMACIÓN DEL PROFESOR SERIALIZADA</b><br>';
$aux = serialize($profe);
var_dump($aux);

echo "<br><b>TRAS LA DESERIALIZACIÓN</b><br>";
$prof_nuevo = unserialize($aux);
var_dump($prof_nuevo);