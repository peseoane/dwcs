<!DOCTYPE html>
<html lang="es">
<head>
    <title>Cálculo del Máximo Común Divisor</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Cálculo del Máximo Común Divisor</h1>

<form method="post" action="">
    <label for="num1">Ingrese el primer número:</label>
    <input type="number" id="num1" name="num1" required><br>

    <label for="num2">Ingrese el segundo número:</label>
    <input type="number" id="num2" name="num2" required><br>

    <input type="submit" value="Calcular MCD">
</form>

<?php
function calcular_mcd($a, $b)
{
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];

    if ($num1 < 0 || $num2 < 0) {
        echo "<p>Por favor, ingrese números enteros positivos.</p>";
    } else {
        $mcd = calcular_mcd($num1, $num2);
        echo "<p>El Máximo Común Divisor (MCD) de $num1 y $num2 es: $mcd</p>";
    }
}
?>
</body>
</html>