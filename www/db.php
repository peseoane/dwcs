<?php
$mysqli = new mysqli("mysql", "dwcs", "dwcs", "dwcs");
if ($mysqli->connect_errno) {
    echo "Falló la conexión con MySQL: (" .
        $mysqli->connect_errno .
        ") " .
        $mysqli->connect_error;
}

if (
    !$mysqli->query("DROP TABLE IF EXISTS test") ||
    !$mysqli->query("CREATE TABLE test(id INT)") ||
    !$mysqli->query("INSERT INTO test(id) VALUES (1)")
) {
    echo "Falló la creación de la tabla: (" .
        $mysqli->errno .
        ") " .
        $mysqli->error;
}
?>
