<?php

$mysqli = new mysqli("localhost", "root", "", "musica");
if ($mysqli->connect_error)
    die($mysqli->connect_error);
$sql = "UPDATE artistas SET nombre_artista =   
   'Eminem', pais_artista='US' WHERE id_artista=10";

if ($mysqli->query($sql) === true)
    echo $mysqli->affected_rows . ' filas actualizadas';
// query devuelve tipos distintos en según la sentencia
else
    echo "ERROR: " . $mysqli->error;
$mysqli->close();
?>
