<DOCTYPE html>
    <html lang="es">
    <head>
        <title>DNI</title>
        <meta charset="UTF-8">
        <meta name="author" content="Seoane Prado, Pedro Vicente">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./bootstrap.css">
    </head>
    <body>
    <h1>Ejercicio 2</h1>
    <p>
        Cree un fichero PHP que permita comprobar las capacidades aritméticas de PHP. Para ello, cree dos variables
        $operador1 y $operador2. Asígnele los valores 13 y 4, respectivamente. Defina una tercera variable $resultado y
        escriba un código que permita hacer las siguientes operaciones:
    </p>

    <ul>
        <li>13-4</li>
        <li>13+4</li>
        <li>13*4</li>
        <li>13/4</li>
        <li>13%4</li>
    </ul>


    <?php
    $operador1 = 13;
    $operador2 = 4;
    $resultado = $operador1 - $operador2;
    echo "<p>$operador1 - $operador2 = $resultado</p>";
    $resultado = $operador1 + $operador2;
    echo "<p>$operador1 + $operador2 = $resultado</p>";
    $resultado = $operador1 * $operador2;
    echo "<p>$operador1 * $operador2 = $resultado</p>";
    $resultado = $operador1 / $operador2;
    echo "<p>$operador1 / $operador2 = $resultado</p>";
    ?>

    </body>
    </html>