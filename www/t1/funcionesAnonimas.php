<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Funciones anónimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">
<h1>Funciones anónimas</h1>
<p>Se deben crear dos funciones anónimas (clausuras) llamadas doble y triple con sintaxis de funciones variables.</p>
<p>La función doble debe recibir un parámetro por cabecera, modificar su valor y devolver el doble de ese parámetro.</p>
<p>La función triple debe recibir un parámetro situado en un contexto superior utilizando la palabra reservada use y
    modificar su valor para que devuelva el parámetro pasado en la llamada a la función multiplicado tres veces por sí
    mismo.</p>
<h2>Introduce número:</h2>
<form action="funcionesAnonimas.php" method="post">
    <input type="number" name="numero" id="numero" type="number"  step="any">
    <input type="submit" value="Enviar">
</form>
<ul>
    <?php



    $numero = null;
    $numeroDoble = null;
    $numeroTriple = null;

    $doble = function (float|int $val): float|int {
        return pow($val, 2);
    };

    $triple = function () use (&$numeroDoble): float|int {
        return pow($numeroDoble, 3);
    };

    if (isset($_POST['numero'])) {
        $numero = $_POST['numero'];

        if ($numero > PHP_FLOAT_MAX || $numero < -PHP_FLOAT_MAX) {
            echo '<div class="alert alert-danger" role="alert">
                    Desbordamiento al calcular el cuadrado. Por favor, introduce un número más pequeño.
                  </div>';
        } else {
            $numeroDoble = $doble($numero);
        }

        if ($numeroDoble > PHP_FLOAT_MAX || $numeroDoble < -PHP_FLOAT_MAX) {
            echo '<div class="alert alert-danger" role="alert">
                    Desbordamiento al calcular el triple. Por favor, introduce un número más pequeño.
                  </div>';
        } else {
            $numeroTriple = $triple();
        }

        echo "<li>Número original $numero</li>";
        if ($numeroDoble !== null) {
            echo "<li>Número doble " . $numeroDoble . "</li>";
        }
        if ($numeroTriple !== null) {
            echo "<li>Número triple " . $numeroTriple . "</li>";
        }
    }

    var_dump($numeroDoble);

    ?>
</ul>
<footer>
    Seoane Prado, Pedro Vicente
</footer>
</body>
</html>