<html lang="es">
<!-- Pedro Seoane Prado 2º DAI -->
<head>
    <title>Primer ejemplo</title>
</head>
<style>
    * {
        font-family: monospace;
    }
</style>
<body>
<h1>Prueba de echo sin evaluación: <br/></h1>
<?php
echo 'Este es el resultado correcto del primer ejercicio';
$var = 1;
echo $var;
echo '<br>';
echo 'echo $var++ = ';
echo $var++;
echo '<br>echo ++$var = ';
echo ++$var;

?>
</body>
</html>