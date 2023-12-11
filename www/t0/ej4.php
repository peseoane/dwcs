<!DOCTYPE html>
<html lang="es">
<head>
    <title>Información de Variable</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Ejercicio 4</h1>
<p>Mostrar información de una variable utilizando var_dump()</p>

<?php
$nombre = "Juan";

echo "<pre>";
var_dump($nombre);
echo "</pre>";

$nombre = null;

echo "<p>Set -> Valor actual es : ";
var_dump($nombre);
echo $nombre;
echo "</p>";
?>
</body>
</html>