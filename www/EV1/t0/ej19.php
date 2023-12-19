<!DOCTYPE html>
<html lang="es">
<head>
    <title>Filtrar elementos menores que un límite</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div>
    <h1>Filtrar elementos menores que un límite</h1>

    <form method="post" action="">
        <label for="numeros">Ingrese números separados por comas:</label>
        <input type="text" id="numeros" name="numeros" placeholder="Ej. 5,10,3" required><br><br>

        <label for="limite">Límite:</label>
        <input type="number" id="limite" name="limite" required><br><br>

        <input type="submit" value="Filtrar">
    </form>

    <?php
    function filtrar_elementos_menores($array, $limite)
    {
        $resultados = [];
        foreach ($array as $elemento) {
            if ($elemento < $limite) {
                //$resultados[] = $elemento; // sintaxis rara... era mas claro un array_push o algo asi :( esto no se entiende
                // si hay push pop desde la arquitectura de von neumann porque reinventamos la rueda?
                array_push($resultados, $elemento); // mucho mejor!
            }
        }
        return $resultados;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numeros = $_POST["numeros"];
        $limite = (int) $_POST["limite"];

        $numeros_array = array_map("intval", explode(",", $numeros));
        $resultado = filtrar_elementos_menores($numeros_array, $limite);

        echo "<h3>Resultado:</h3>";
        echo "Elementos menores que el límite ($limite): " .
            implode(", ", $resultado);
    }
    ?>
</div>
</body>
</html>