<?php

//Especificar dominio y directorio de la cookie
/*
 * Si ejecutamos el fichero nos indica que se enviaron correctamente las peticiones
 * de creación de las cookies, pero sólo podemos estar seguros de que se creó 
 * la cookie4 pues está situada en nuestro dominio y nuestro subdirectorio. 
 * Visualizarlo con el addon de Firefox 
 */
$cook3 = setcookie("cookie3", "Valor de cookie 3", time() + 3000, "/ruta/", "dominio.com");
$cook4 = setcookie("cookie4", "Valor de cookie 4", time() + 3000, "/pruebasCookies/cookies/directorio_rol", "localhost.com");
if ($cook3 & $cook4)
    echo "La petición de la creación de las cookies se envió con éxito";
?>