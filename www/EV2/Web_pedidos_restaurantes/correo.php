<?php
/*
 * Utilizamos la librería de terceros PHPMailer proporcionada por Composer
 */
use PHPMailer\PHPMailer\PHPMailer;

require dirname(__FILE__) . "/vendor/autoload.php";

function enviar_correos($carrito, $pedido, $correo) {
    /*
     * Envía un correo de confirmación al restaurante que ha realizado el pedido
     * y al departamento de pedidos. El correo incluye el número del pedido, el 
     * restaurante que lo realiza y una tabla HTML con los productos del pedido.
     */
    $cuerpo = crear_correo($carrito, $pedido, $correo);
    $correo_Departamento_Pedidos = ""; //Poner al responsable del departamento de pedidos
    return enviar_correo_multiples("$correo, $correo_Departamento_Pedidos",
            $cuerpo, "Pedido $pedido confirmado");
}

function crear_correo($carrito, $pedido, $correo) {
    /*
     * Crea la tabla HTML con los productos que se piden, incluyendo el peso
     */
    $pesoTotal = 0;
    $texto = "<h1>Pedido nº $pedido[0]</h1><h2>Restaurante: $correo </h2>";
    $texto .= "Detalle del pedido:";
    //Los datos de los productos de los pedido que irán en el cuerpo del mensaje como una tabla
    $productos = cargar_productos(array_keys($carrito));
    $texto .= "<table>"; //abrir la tabla
    $texto .= "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Unidades</th></tr>";
    foreach ($productos as $producto) {
        $cod = $producto['CodProd'];
        $nom = $producto['Nombre'];
        $des = $producto['Descripcion'];
        $peso = $producto['Peso'];
        $unidades = $_SESSION['carrito'][$cod];
        $pesoTotal += $peso * $unidades;
        $texto .= "<tr><td>$nom</td><td>$des</td><td>$peso</td><td>$unidades</td>
		<td> </tr>";
    }
    $texto .= "<tr><td>Peso Total</td><td>$pesoTotal</td> </tr>";
    $texto .= "</table>";
    return $texto;
}

function enviar_correo_multiples($lista_correos, $cuerpo, $asunto = "") {
    /*
     * Recibe un array de direcciones de correo, el cuerpo del correo y el asunto.
     * Envía el correo a todas las direcciones.
     */
    $res = leer_configCorreo(dirname(__FILE__) . "/config/correo.xml", dirname(__FILE__) . "/config/correo.xsd");
    $mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;  // cambiar a 1 o 2 para ver errores
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "iesteis-es.correoseguro.dinaserver.com";
    $mail->Port = 587;
    $mail->Username = $res[0];  //usuario de gmail
    $mail->Password = $res[1]; //contraseña de gmail          
    $mail->SetFrom('usuario_correo@gmail.com', 'Sistema de pedidos');
    $mail->Subject = mb_convert_encoding($asunto,'UTF-8');
    $mail->MsgHTML($cuerpo);
    /* Divide la lista de correos por la coma */
    $correos = explode(",", $lista_correos);
    foreach ($correos as $correo) {
        $mail->AddAddress($correo, $correo);
    }
    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return TRUE;
    }
}

function leer_configCorreo($nombre, $esquema) {
    /*
     * Recibe dos parámetros: 
     * 1. $nombre: fichero de configuración con los datos (usuario y clave) para enviar un correo
     * 2. $esquema: fichero de validación,para comprobar la estructura que se espera
     * del fichero de configuración 
     */
    $config = new DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Revise fichero de configuración");
    }
    $datos = simplexml_load_file($nombre);
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");
    $resul = [];
    $resul[] = $usu[0];
    $resul[] = $clave[0];
    return $resul;
}
