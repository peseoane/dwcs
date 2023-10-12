<!DOCTYPE html>
<html lang="es">
<head>
    <title>Comprobar si una Frase está en Minúsculas</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Comprobar si una Frase está en Minúsculas</h1>

<form method="post" action="">
    <label for="input_frase">Ingrese una frase:</label>
    <input type="text" id="input_frase" name="input_frase" required><br>

    <input type="submit" value="Comprobar">
</form>

<?php
function frase_en_minusculas($frase) {
    return $frase === strtolower($frase);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_frase = $_POST["input_frase"];
    $resultado = frase_en_minusculas($input_frase);
    echo "<p>Frase: \"$input_frase\"</p>";
    echo "<p>¿Está en minúsculas? " . ($resultado ? "Sí" : "No") . "</p>";
}
?>
</body>
</html>