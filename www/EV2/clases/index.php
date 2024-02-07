<?php

include "autoload.php";

use \Persona\Profesor as teacher;
use \Persona\Alumno as student;
use \AcademiaBaile\Baile as baile;
use \AcademiaBaile\Academia as academy;

$profesores = array();
$alumnos = array();
$prof1 = new teacher("Patricia", "González", 619111111, 456789);
$prof1->anadeBaile("Salsa", 10);
$prof1->anadeBaile("Bachata", 12);
array_push($profesores, $prof1);

$alum1 = new student("María", "Gutiérrez", 619222222, 8);
$alum2 = new student("Juan", "Suárez", 619333333, 15);

array_push($alumnos, $alum1);
array_push($alumnos, $alum2);

echo "De la academia de Baile con nombre <b>".academy::NOMBRE_ACADEMIA."</b> poseemos la siguiente información<br><br>";
echo '<b>INFORMACIÓN DE LOS ALUMNOS</b><br>';
foreach ($alumnos as $val => $alumno) {
    echo "<br>" . $alumno->verInformacion();
}

echo '<br><br><b>INFORMACIÓN DE LOS PROFESORES</b><br>';
foreach ($profesores as $val => $profe) {
    echo "<br>" . $profe->verInformacion();
    echo '<br><br><b>BAILES QUE IMPARTE EL PROFESOR: </b><br><br>';
    $profe->muestraBailes();
}