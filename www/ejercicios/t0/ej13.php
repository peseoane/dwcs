<!DOCTYPE html>
<html lang="es">
<head>
    <title>Temperaturas de Abril</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Temperaturas de Abril</h1>

<?php
$temperaturas = [];
for ($i = 0; $i < 30; $i++) {
    $temperaturas[$i] = rand(5, 25); // Lenguaje interpretado... no puede desenrollar el bucle no se puede optimizar
    // por eso la industria nos movemos a Go o lo que sea... es como la broma you just don't loop in python
}

$media = array_sum($temperaturas) / count($temperaturas);

sort($temperaturas);

$temp_bajas = array_slice($temperaturas, 0, 5);

$temp_altas = array_slice($temperaturas, -5);

echo "<p>Temperaturas de abril: " . implode(", ", $temperaturas) . " &deg;C</p>";
echo "<p>Media de temperaturas: " . number_format($media, 2) . " &deg;C</p>";
echo "<p>Cinco temperaturas más bajas: " . implode(", ", $temp_bajas) . " &deg;C</p>";
echo "<p>Cinco temperaturas más altas: " . implode(", ", $temp_altas) . " &deg;C</p>";
?>
</body>
</html>