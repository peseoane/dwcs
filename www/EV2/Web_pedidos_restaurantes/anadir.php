<?php

/*
 * Añade productos al carrito. Recibe el código del producto, la cantidad de unidades
 * que queremos y una vez hecho nos redirige al carrito de la compra
 */

/* Comprueba que el usuario haya abierto sesión o redirige */
require_once 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
$cod = $_POST['cod'];
$unidades = (int) $_POST['unidades'];
/* si existe el código sumamos las unidades */
if (isset($_SESSION['carrito'][$cod])) {
    $_SESSION['carrito'][$cod] += $unidades;
} else {
    $_SESSION['carrito'][$cod] = $unidades;
}
//$codCat = cargar_categoria_codProducto($cod)[0];
header("Location: carrito.php");
