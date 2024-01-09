<?php
$mysqli = new mysqli("localhost", "root", "", "musica");
if ($mysqli->connect_error) {
    die(
        "Error de Conexión (" .
            $mysqli->connect_errno .
            ") " .
            "<br>" .
            $mysqli->connect_error
    );
}

$sql = "SELECT id_artista, nombre_artista FROM artistas";
if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
        // clase mysqli_result
        while ($fila = $result->fetch_object()) {
            echo $fila->id_artista . ":" . $fila->nombre_artista . "<br>\n";
        }
        $result->close();
    } else {
        echo "No se han encontrado registros.";
    }
} else {
    echo "ERROR: " . $mysqli->error;
} // último error
$mysqli->close(); // cerrar la conexión
//
?>
