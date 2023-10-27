<?php

$nombre = $_POST['nombre'];
$modulos = $_POST['modulos'];
print "Nombre: " . $nombre . "<br />";
foreach ($modulos as $modulo) {
    print "Modulo: " . $modulo . "<br />";
}
?>
