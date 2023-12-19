<!DOCTYPE html>
<html lang="es">
<head>
    <title>Suma de Dos Números</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Ejercicio 6</h1>
<p>Suma de dos números utilizando un formulario ¿No queda claro si usar form u hacerlo en local?</p>

<form method="post" action="">
    <label for="numero1">Primer número:</label>
    <input type="number" id="numero1" name="numero1" required><br>

    <label for="numero2">Segundo número:</label>
    <input type="number" id="numero2" name="numero2" required><br>

    <input type="submit" value="Calcular">
</form>

<?php
function suma($num1, $num2)
{
    return $num1 + $num2;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = $_POST["numero1"];
    $numero2 = $_POST["numero2"];
    $resultado = suma($numero1, $numero2);
    echo "<p>La suma de $numero1 y $numero2 es: $resultado</p>";
}
?>
</body>
</html>