<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ejercicio 10: Manipulación de Cadena de Caracteres</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Ejercicio 10: Manipulación de Cadena de Caracteres</h1>

<form method="post" action="">
    <label for="texto">Ingrese un texto:</label>
    <input type="text" id="texto" name="texto" value="<?php echo isset(
        $_POST["texto"]
    )
        ? htmlspecialchars($_POST["texto"])
        : "Sin problema"; ?>" required><br>

    <input type="submit" value="Realizar Acciones">
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST["texto"];

    echo "<p>Texto ingresado: $texto</p>";

    $num_caracteres = strlen($texto);
    echo "<p>1.1. Número de caracteres: $num_caracteres</p>";

    $pos_problema = strpos($texto, "problema");
    echo "<p>1.2. Posición de 'problema': $pos_problema</p>";

    $texto_modificado = str_replace("problema", "problemas", $texto);
    echo "<p>1.3. Texto modificado: $texto_modificado</p>";

    echo "<p>1.4. Caracteres con ASCII 65, 66 y 67: " .
        chr(65) .
        chr(66) .
        chr(67) .
        "</p>";

    $texto_mayusculas_n = str_replace("n", "N", $texto);
    echo "<p>1.5. Texto con 'n' en mayúsculas: $texto_mayusculas_n</p>";

    echo "<p>1.6. Texto en mayúsculas: " . strtoupper($texto) . "</p>";
    echo "<p>1.6. Texto en minúsculas: " . strtolower($texto) . "</p>";

    $texto_sin_espacios = ltrim($texto);
    echo "<p>1.7. Texto sin espacios en blanco al principio: $texto_sin_espacios</p>";

    $texto_al_reves = strrev($texto);
    echo "<p>1.8. Texto al revés: $texto_al_reves</p>";

    $num_o = substr_count($texto, "o");
    echo "<p>1.9. Número de veces que aparece la letra 'o': $num_o</p>";
} ?>
</body>
</html>