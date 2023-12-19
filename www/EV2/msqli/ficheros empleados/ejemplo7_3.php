<?php

$mysqli = new mysqli("localhost", "root", "", "musica");
if ($mysqli === false)
    die("ERROR al conectar. " . mysqli_connect_error());
$sql = "SELECT id_artista, nombre_artista FROM artistas";
if ($result = $mysqli->query($sql))
    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_array())  // asoc+index
            echo $fila[0] . ":" . $fila[1] . "<br>\n";
        $result->close();
    } else
        echo "No se han encontrado registros.";
else
    echo "ERROR: " . $mysqli->error;
$mysqli->close();
?> 
