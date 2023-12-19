<?php

$mysqli = new mysqli("localhost", "root", "", "musica");
if ($mysqli->connect_error) {
    die($mysqli->connect_error);
    echo "Error de conexión con la base de datos";
}
$sql = "SELECT id_artista, nombre_artista FROM artistas";
if ($result = $mysqli->query($sql)) {  // clase mysqli_result
    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_array()) //asoc+index
            echo $fila['id_artista'] . ":" .
            $fila['nombre_artista'] . "<br/>";
        $result->close();
    } else
        echo "No se han encontrado registros.";
} else
    echo "ERROR: " . $mysqli->error;
$mysqli->close();
?> 
