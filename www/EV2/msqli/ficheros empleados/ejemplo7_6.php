<?php

// define los valores a insertar
$canciones = array(
    array('Chiquitita', 5),
    array('Mamma mia', 4),
    array('Shine', 12),
    array('Hold On', 9),
);
$mysqli = new mysqli("localhost", "root", "", "musica");
if ($mysqli->connect_error)
    die($mysqli->connect_error);
// preparar el modelo de sentencia
$sql = "INSERT INTO canciones (titulo_cancion, 	fk_artista_cancion) 
	VALUES (?, ?)";
if ($stmt = $mysqli->prepare($sql)) {
    foreach ($canciones as $c) {
        $stmt->bind_param('si', $c[0], $c[1]);
        if ($stmt->execute())
            echo "nueva canción con id: " .
            $mysqli->insert_id . " añadida.<br>\n";
        else
            echo "No se pudo ejecutar la sentencia: $sql. "
            . $mysqli->error;
    }
    $stmt->close();
} else
    echo "No se pudo preparar la sentencia: $sql. "
    . $mysqli->error;
$mysqli->close();  // cierra la conexión
//TIPOS DEL PRIMER ARGUMENTO DE BIND_PARAM:
//   i: integer
//   d: double
//   s: string
//   b: blob 
//prepared statements:
//•	Más seguros (SQL Injection)
//•	Precompilados: ahorro de tiempo de compilación en el servidor de base de datos.
?> 