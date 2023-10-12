<!DOCTYPE html>
<html lang="es">
<head>
    <title>Procedimiento que Imprime Mensaje con Formulario</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Ejercicio 7 con Formulario</h1>
<p>Procedimiento que imprime un mensaje</p>

<form method="post" action="">
    <label for="mensaje">Ingrese un mensaje:</label>
    <input type="text" id="mensaje" name="mensaje" required><br>

    <input type="submit" value="Imprimir Mensaje">
</form>

<?php
function imprimirMensaje($mensaje) {
    echo "<p>Mensaje: $mensaje</p>";
}

// Si sigue igual que el antiguo PHP hay que hacerlo asi para evitar autocapturas al hacer el templating inicial.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensaje = $_POST["mensaje"];
    imprimirMensaje($mensaje);
}
?>
</body>
</html>