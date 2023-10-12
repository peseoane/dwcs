<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ejercicio 9: Verificar si un número es decimal (coma flotante)</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Ejercicio 9: Verificar si un número es decimal (coma flotante)</h1>

<form method="post" action="">
    <label for="numero_decimal">Ingrese un número decimal:</label>
    <input type="text" id="numero_decimal" name="numero_decimal" required><br>

    <input type="submit" value="Verificar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_decimal = $_POST["numero_decimal"];

    $numero_decimal = str_replace(',', '.', $numero_decimal);

    if (is_numeric($numero_decimal) && strpos($numero_decimal, '.') !== false) {
        echo "<p>El número ingresado ($numero_decimal) es de tipo decimal (coma flotante).</p>";
    } else {
        echo "<p>El número ingresado ($numero_decimal) no es de tipo decimal (coma flotante).</p>";
    }
}
?>
</body>
</html>