<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resolución de Ecuación de Segundo Grado</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Resolución de Ecuación de Segundo Grado</h1>

<form method="post" action="">
    <label for="coef_a">Coeficiente a:</label>
    <input type="number" id="coef_a" name="coef_a" step="any" required><br>

    <label for="coef_b">Coeficiente b:</label>
    <input type="number" id="coef_b" name="coef_b" step="any" required><br>

    <label for="coef_c">Coeficiente c:</label>
    <input type="number" id="coef_c" name="coef_c" step="any" required><br>

    <input type="submit" value="Resolver Ecuación">
</form>

<?php
function resolver_ecuacion_segundo_grado($a, $b, $c) {
    if ($a == 0) {
        return false;  // Será otra cosa no y=mx2+nx+p
    }

    $delta = $b * $b - 4 * $a * $c;

    if ($delta < 0) {
        return false;  // No vamos a ponernos con imaginarios ahora hombre...
    } elseif ($delta == 0) {
        $solucion = -($b / (2 * $a));
        return [$solucion];
    } else {
        $solucion1 = (-$b + sqrt($delta)) / (2 * $a);
        $solucion2 = (-$b - sqrt($delta)) / (2 * $a);
        return [$solucion1, $solucion2];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coef_a = $_POST["coef_a"];
    $coef_b = $_POST["coef_b"];
    $coef_c = $_POST["coef_c"];

    $soluciones = resolver_ecuacion_segundo_grado($coef_a, $coef_b, $coef_c);

    if ($soluciones === false) {
        echo "<p>No hay soluciones reales para la ecuación proporcionada.</p>";
    } else {
        echo "<p>Las soluciones de la ecuación son: " . implode(", ", $soluciones) . "</p>";
    }
}
?>
</body>
</html>