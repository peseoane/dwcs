<!DOCTYPE html>
<html lang="es">
<head>
    <title>Verificador de Palíndromos</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Verificador de Palíndromos</h1>

    <form method="post" action="">
        <div class="form-group">
            <label for="cadena">Ingrese una cadena:</label>
            <input type="text" class="form-control" id="cadena" name="cadena" required>
        </div>

        <button type="submit" class="btn btn-primary">Verificar</button>
    </form>

    <?php
    function es_palindromo($cadena) {
        $cadena_invertida = strrev($cadena);
        return $cadena_invertida === $cadena;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cadena = $_POST["cadena"];
        $resultado = es_palindromo($cadena);

        echo "<h3>Resultado:</h3>";
        if ($resultado) {
            echo "<p>'$cadena' es un palíndromo.</p>";
        } else {
            echo "<p>'$cadena' no es un palíndromo.</p>";
        }
    }
    ?>
</body>
</html>