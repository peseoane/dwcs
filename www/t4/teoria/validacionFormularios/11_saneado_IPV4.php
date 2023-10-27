<?php

//http://localhost/validacionFormularios/11_saneado_IPV4.php?ip=192.168.100.1
//http://localhost/validacionFormularios/11_saneado_IPV4.php?ip=192.168.100
$ipv4 = $_GET['ip'];
if (filter_var($_GET['ip'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    echo "La dirección $ipv4 es correcta";
} else {
    echo "La dirección $ipv4 NO es correcta";
}
