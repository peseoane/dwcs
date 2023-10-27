<?php

/* Ejecutar la siguiente línea
 * http://localhost/validacionFormularios/9_saneado_termino.php?dato=O'Connor
 * y después ver el código fuente generado (Control+U) en Windows
 */
$dato = $_GET['dato'];
$dato_saneado = filter_var($dato, FILTER_SANITIZE_SPECIAL_CHARS);
echo "El dato original es $dato<br>\n";
echo "El dato saneado es $dato_saneado";
?>