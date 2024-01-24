<?php
/*
 * Inserta el pedido en la BBDD, enviando correos de confirmación y muestra mensajes
 * de error o de éxito.
 */

/* Comprueba que el usuario haya abierto sesión o redirige */
require 'correo.php';
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
?>	
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Pedidos</title>		
    </head>
    <body>
        <?php
        require 'cabecera.php';
        $resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['codRes']);
        if ($resul === FALSE) {
            echo "No se ha podido realizar el pedido<br>";
        } else {
            $correo = $_SESSION['usuario']['correo'];
            echo "Pedido realizado con éxito. Se enviará un correo de confirmación a: $correo ";
            $conf = enviar_correos($_SESSION['carrito'], $resul, $correo);
            if ($conf !== TRUE) {
                echo "Error al enviar: $conf <br>";
            };
            //Vacia el carrito pues o bien se hizo el pedido o bien hubo un error
            $_SESSION['carrito'] = [];
        }
        ?>		
    </body>
</html>
