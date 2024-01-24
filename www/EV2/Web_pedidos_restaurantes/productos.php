<?php
/*
 * Muestra una tabla con todos los elementos de una categoría y permite añadirlos al 
 * carrito. Al mostrar la tabla de productos, se añade a cada fila un formulario para 
 * añadir uno o más unidades de ese producto al carrito.
 * Recibe por GET la cateogría de los productos a mostrar.
 */

/* Comprueba que el usuario haya abierto sesión o redirige */
require 'sesiones.php';
require_once 'bd.php';
comprobar_sesion();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Tabla de productos por categoría</title>		
    </head>
    <body>
        <?php
        require 'cabecera.php';
        $cat = cargar_categoria($_GET['categoria']); //array con el nombre y descripción de una categoría
        // Obtenemos un puntero con los productos que tienen stock
        $productos = cargar_productos_categoria($_GET['categoria']); 
        if ($cat === FALSE or $productos === FALSE) {
            echo "<p class='error'>Error al conectar con la base datos</p>";
            exit;
        }
        echo "<h1>" . $cat['nombre'] . "</h1>";
        echo "<p>" . $cat['descripcion'] . "</p>";
        echo "<table>"; //abrir la tabla
        echo "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Stock</th><th>Comprar</th></tr>";
        foreach ($productos as $producto) {
            $cod = $producto['CodProd'];
            $nom = $producto['Nombre'];
            $des = $producto['Descripcion'];
            $peso = $producto['Peso'];
            $stock = $producto['Stock'];
            /*
             * Dentro del formulario hay un campo oculto para enviar el código del producto
             * que debemos añadir al carro del la compra. El formulario llama al fichero anadir.php
             */
            echo "<tr><td>$nom</td><td>$des</td><td>$peso</td><td>$stock</td>
			<td><form action = 'anadir.php' method = 'POST'>
			<input name = 'unidades' type='number' min = '1' value = '1'>
			<input type = 'submit' value='Comprar'><input name = 'cod' type='hidden' value = '$cod'>
			</form></td></tr>";
        }
        echo "</table>"
        ?>				
    </body>
</html>