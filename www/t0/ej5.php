<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tipo de Variable con gettype()</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Ejercicio 5</h1>
<p>Mostrar el tipo de variable utilizando la función gettype()</p>

<?php
$temporal1 = "Juan";
$temporal2 = 3.14;
$temporal3 = false;
$temporal4 = 3;
$temporal5 = null;

echo "<p>El tipo de \$temporal1 es: " . gettype($temporal1) . "</p>";
echo "<p>El tipo de \$temporal2 es: " . gettype($temporal2) . "</p>";
echo "<p>El tipo de \$temporal3 es: " . gettype($temporal3) . "</p>";
echo "<p>El tipo de \$temporal4 es: " . gettype($temporal4) . "</p>";
echo "<p>El tipo de \$temporal5 es: " . gettype($temporal5) . "</p>";
?>
</body>
</html>