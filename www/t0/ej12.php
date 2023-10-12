<!DOCTYPE html>
<html lang="es">
<head>
    <title>DNI</title>
    <meta charset="UTF-8">
    <!-- add author and description -->
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>

<?php
function validar_dni($dni)
{
    $dni = preg_replace("/[^0-9A-Za-z]/", "", $dni);

    if (strlen($dni) !== 9) {
        return -1;
    }

    $numericPart = substr($dni, 0, 8);
    if (!is_numeric($numericPart)) {
        return -2;
    }

    $numero = intval($numericPart);
    $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
    $letraEsperada = $letras[$numero % 23];

    if (strtoupper($dni[8]) !== $letraEsperada) {
        return -3;
    }

    return 0;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dni = $_POST["dni"];

    $resultado = validar_dni($dni);

    if ($resultado === 0) {
        echo "<div class='alter-danger'> El DNI $dni es válido.</div>";
    } else {
        echo "<div class='alter-sucess'> El DNI $dni no es válido. Código de error: $resultado</div>";
    }
}
?>
<div class="m-3">
    <form method="post" class="form-check alert-danger" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Validador de DNI</h1>

        <label for="dni">Ingrese su DNI (ocho números y una letra, sin espacios ni puntos):</label>
        <input type="text" id="dni" name="dni">
        <button type="submit">Validar</button>
    </form>
</div>
</body>
</html>
