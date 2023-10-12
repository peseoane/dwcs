<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ejercicio 8: Año Bisiesto</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Ejercicio 8: Verificar si un año es bisiesto</h1>

<form method="post" action="">
    <label for="anio">Ingrese un año:</label>
    <input type="number" id="anio" name="anio" required><br>

    <input type="submit" value="Verificar">
</form>

<?php
function esBisiesto($anio) {
    return ($anio % 400 == 0) || ($anio % 4 == 0 && $anio % 100 != 0);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anio = $_POST["anio"];

    if (esBisiesto($anio)) {
        echo "<p>El año $anio es bisiesto.</p>";
    } else {
        echo "<p>El año $anio no es bisiesto.</p>";
    }
}
?>
</body>
</html>