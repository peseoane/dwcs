<!DOCTYPE html>
<html>
    <head>
        <title>"Validación de IPv6</title>
    </head>
    <body>
        <?php
//Probar con las dos ips y ver la diferencia (la 2ª no está en hexadecimal
//        $ip = "fe80::30d3:bfab:54ea:b8a5";
        $ip = "fe80::30d3:bfab:54ea:b8a5R";

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            echo("$ip es una dirección IPv6 válida");
        } else {
            echo("$ip NO es una dirección IPv6 válida");
        }
        ?>
    </body>
</html>
