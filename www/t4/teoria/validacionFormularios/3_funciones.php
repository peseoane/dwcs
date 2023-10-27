<?php

function test_input($data) {
    $datos = trim($data);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}
