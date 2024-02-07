<?php

function loadBBDD()
{
    /*
     * Devuelve el puntero a la conexión a la BBDD
     */
    try {
        $res = leer_config(dirname(__FILE__) . "/config/configuracion.xml", dirname(__FILE__) . "/config/configuracion.xsd");
        $bd = new PDO($res[0], $res[1], $res[2]);
        return $bd;
    } catch (\Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

function leer_config($fichero_config_BBDD, $esquema)
{
    /*
     * $fichero_config_BBDD es la ruta del fichero con los datos de conexión a la BBDD
     * $esquema es la ruta del fichero XSD para validar la estructura del fichero anterior
     * Si el fichero de configuración existe y es válido, devuelve un array con tres
     * valores: la cadena de conexión, el nombre de usuario y la clave.
     * Si no encuentra el fichero o no es válido, lanza una excepción.
     */

    $config = new DOMDocument();
    $config->load($fichero_config_BBDD);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Revise el fichero de configuración");
    }
    $datos = simplexml_load_file($fichero_config_BBDD);
    $ip = $datos->xpath("//ip");
    $nombre = $datos->xpath("//nombre");
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");
    $cad = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);
    $resul = [];
    $resul[] = $cad;
    $resul[] = $usu[0];
    $resul[] = $clave[0];
    return $resul;
}

function loadPass($nombre)
{
    /*
     *  Recupera la contraseña encriptada de la BBDD cuyo usuario (a través del
     *  parámetro nombre) es la dirección de correo del usuario que va a realizar el pedido
     */
    $bd = loadBBDD();
    $ins = "select clave from restaurantes where correo= '$nombre'";
    $stmt = $bd->query($ins);
    $resul = $stmt->fetch();
    $devol = false;
    if ($resul !== false) {
        $devol = $resul['clave'];
    }
    return $devol;
}

function comprobar_usuario($nombre, $clave)
{

    /*
     * Comprueba los datos que recibe del formulario del login. Si los datos son correctos
     * devuelve un array con dos campos: codRes (el código del restaurante) y correo 
     * con su correo. En caso de error devuelve false
     */
    $devol = FALSE;
    $bd = loadBBDD();
    $hash = loadPass($nombre);
    if (password_verify($clave, $hash)) {
        $ins = "select codRes, correo from restaurantes where correo = '$nombre' ";
        $resul = $bd->query($ins);
        if ($resul->rowCount() === 1) {
            $devol = $resul->fetch();
        }
    }
    return $devol;
}

function cargar_categorias()
{
    /*
     * Devuelve un puntero con el código y nombre de las categorías de la BBDD
     * o falso si se produjo un error
     */
    $bd = loadBBDD();
    $ins = "select codCat, nombre from categoria";
    $resul = $bd->query($ins);
    if (!$resul) {
        return FALSE;
    }
    if ($resul->rowCount() === 0) {
        return FALSE;
    }
    //si hay 1 o más
    return $resul;
}

function cargar_categoria($codCat)
{
    /*
     * Recibe el código de una categoría y devuelve un array con su nombre y descripción.
     * Si hay algún error en la BBDD o la categoría no existe devuelve FALSE
     */
    $bd = loadBBDD();
    $ins = "select nombre, descripcion from categoria where codcat = $codCat";
    $resul = $bd->query($ins);
    if (!$resul) {
        return FALSE;
    }
    if ($resul->rowCount() === 0) {
        return FALSE;
    }
    //si hay 1 o más
    return $resul->fetch();
}

function cargar_productos_categoria($codCat)
{
    /*
     * Recibe el código de una categoría y devuelve un puntero (PDOStatement) con los 
     * productos que tienen stock, incluyendo todas las columnas de la BBDD.
     */
    $bd = loadBBDD();
    $sql = "select * from productos where codCat  = $codCat AND stock>0";
    $resul = $bd->query($sql);
    if (!$resul) {
        return FALSE;
    }
    if ($resul->rowCount() === 0) {
        return FALSE;
    }
    //si hay 1 o más
    return $resul;
}

function cargar_categoria_codProducto($codProd)
{
    /*
     * Nos devuelve la categoría de un producto indicando su código o FALSE si se
     * ha producido un error.
     */
    $bd = loadBBDD();
    $sql = "select CodCat from productos where CodProd  = $codProd";
    $resul = $bd->query($sql);
    if (!$resul) {
        return FALSE;
    }
    if ($resul->rowCount() === 1) {
        return $resul->fetch();
    }
    //si hay 1 o más
    return false;
}

function cargar_productos($codigosProductos)
{
    /*
     * Obtiene la información de los productos que se le pasa como parámetro en
     * forma de un array de códigos de productos.
     */
    $bd = loadBBDD();
    //Para crear la lista de procutos como un texto separado por comas.
    $texto_in = implode(",", $codigosProductos);
    if ($texto_in != "") {
        $ins = "select * from productos where codProd in($texto_in)";
        $resul = $bd->query($ins);
        if (!$resul) {
            return FALSE;
        }
        return $resul;
    } else
        return FALSE;
}

function insertar_pedido($carrito, $codRes): false|string
{
    /*
     * Inserta el pedido en la BBDD. Recibe el carrito de la compra y el código del
     * restaurante que realiza el pedido. Si todo va bien, devuelve el código del nuevo 
     * pedido. Si hay algún error devuelve FALSE.
     * Para ello hay que:
     * 1. Crear una nueva fila en la tabla pedidos.
     * 2. Crear una fila en la tabla PedidosProductos por cada producto diferente que
     * se pida, usando la clave del nuevo pedido.
     * 3. Hay que actualizar el stock de cada producto por cada producto del pedido.
     * 
     * Todas las insercciones tienen que realizarse como una transacción.
     */

    $bd = loadBBDD();
    $bd->beginTransaction();
    try {
        $hora = date("Y-m-d H:i:s", time());
        // insertar el pedido
        $sql1 = "insert into pedidos(fecha, enviado, restaurante) 
			values('$hora',0, $codRes)";
        $bd->query($sql1);

        // coger el id del nuevo pedido para las filas detalle
        $pedido = $bd->lastInsertId();
        // insertar las filas en pedidoproductos
        foreach ($carrito as $codProd => $unidades) {

            /**$sql3 = "Select stock from productos where codprod=?";
             * $stmt3 = $bd->prepare($sql3);
             * $stmt3->execute(array($codProd));**/

            $stmt = $bd->query("Select stock, nombre from productos where codprod=$codProd");
            list($stock, $nombreproducto) = $stmt->fetch();
            if ($stock < $unidades) {
                throw new PDOException("Producto con nombre $nombreproducto con stock menor del solicitado<br");
            }
            $sql4 = "UPDATE productos set stock=? where codProd=?";
            $stmt = $bd->prepare($sql4);
            $stock -= $unidades;
            $stmt->execute(array($stock, $codProd));

            $sql2 = "insert into pedidosproductos(CodPed, CodProd, Unidades) 
		             values( ?, ?, ?)";
            $stmt = $bd->prepare($sql2);
            $stmt->execute(array($pedido, $codProd, $unidades));
        }
        $bd->commit();
        unset($stmt);
        return $pedido;  //devuelve el código del nuevo pedido
    } catch (PDOException $e) {
        echo $e->getMessage();
        $bd->rollback();
        return FALSE;
    } finally {
        unset($bd);
    }
}