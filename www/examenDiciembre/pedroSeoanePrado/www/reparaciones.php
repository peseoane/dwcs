<?php
declare(strict_types=1);
require './Utils.php';
// session_start(); -< ACTIVA POR INYECCION DE DEPENDENCAS.
$fechaReparacion = time();
$nombreOperario = "";
$codigoReparacion = leerUltimoCodigoDeReparacion();
$msgDate = "<p>Hoy es: " . date('l jS \of F Y h:i:s A');

/* Paso de largo no se porque no me quiere leer el POST ahora... */
if (isset($_POST['nombreOperario']) && isset($_POST['descripcion'])) {
    var_dump($_POST['nombreOperario']);
    $_SESSION['reparaciones'][] = array(
        'fecha'          => $fechaReparacion,
        'nombreOperario' => htmlspecialchars(trim($_POST['nombreOperario'])),
        'descripcion'    => htmlspecialchars(trim($_POST['descripcion']))
    ); // Deberia añadirse pero no se porque no puedo leer el POST a saber
} else {
    var_dump($_POST); // No puedo pararme mas con esto no me resuelve host el PC.
    $_SESSION['msg'] = "No se puede leer el POST de la otra página! Error sin manejar";
    header("Location: msg.php");
}

?>

<<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GUARDAR REPARACION</title>
</head>
<body>
<h3>GUARDAR REPARACION</h3>
<p>Estás en reparaciones porque has iniciado session correctamente</p>;

<form method="post" action="reparaciones.php">
    <p>CODIGO DE REPARACION: = <?php echo $codigoReparacion ?> </p>
    <p>FECHA: = <?php echo $fechaReparacion ?> </p>
    <label for="nombreOperario">NombreOperario</label>
    <input for="nombreOperario" type="text" required>
    <br>
    <label for="descripcion">Descripcion del trabajo </label>
    <input for="descripcion" type="text" required>
    <br>
    <input name="registro" type="submit">
</form>


</body>
</html>