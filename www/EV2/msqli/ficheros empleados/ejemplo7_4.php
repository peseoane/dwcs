<?php

$mysqli = new mysqli("localhost", "root", "", "musica");
if ($mysqli->connect_error)
    die($mysqli->connect_error);
// ejecución de sentencia SQL: inserción
// salida: "Nuevo artista con id:13 añadido."
$sql = "INSERT INTO artistas (nombre_artista, pais_artista) 
	VALUES ('Mariah Carey', 'USA')";
if ($mysqli->query($sql) === TRUE)
    echo 'Nuevo artista con id:' . $mysqli->insert_id;
// insert_id: autonumérico (serial, etc.) asignado
else
    echo "Imposible ejecutar: $sql. " . $mysqli->error;
$mysqli->close();
?>


