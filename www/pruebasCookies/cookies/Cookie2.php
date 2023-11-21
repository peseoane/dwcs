<?php
/*
 * setcookie ( string $name [, string $value = "" [, int $expires = 0 
 * [, string $path = "" [, string $domain = "" [, bool $secure = FALSE 
 * [, bool $httponly = FALSE ]]]]]] ) : bool
 * Las directivas Domain y Path definen el alcance de la cookie: a qué URLs 
 * deberían enviarse las cookies. 
 * Domain especifica el (sub)dominio en en cual la cookie está disponible. 
 * Si no se especifica, toma como valor por defecto el host del Document.location actual
 * Por ejemplo, si se establece Domain=cursos.org, las cookies se incluyen en 
 * subdominios como php.cursos.org.
 * Path indica la ruta dentro del servidor en la que la cookie estará disponible. 
 * El carácter %x2F ("/") es considerado un separador de directorios, y 
 * los subdirectorios también coincidirán. Por ejemplo, si se establece 
 * Path=/docs estas rutas coincidirán:
 * /docs
 * /docs/Web/
 * /docs/Web/HTTP
 * 
 * Si no se puede enviar la cookie porque ya exista salida en el navegador devuelve
 * FALSE. Si se ejecuta la función setcookie devuelve true, pero no indica que el
 * usuario haya aceptado la cookie (por ejemplo porque las tenga deshabilitadas.
 */

/*
 * Ejecutar este fichero paso a paso dos veces. Se observa que en la primera vez
 * se envía la petición de creación de la cookie, pero no existe el array
 * $_COOKIE hasta que se ejecuta una segunda vez, (cuando el navegador ha
 * aceptado la cookie). En esta segunda vez con el Xdebug sólo vemos las cookiesgetcwd
 * cuyo directorio es el actual, pero con el addon de Firefox las vemos todas.
 * Si vamos al fichero de directorio_rol y ejecutamos paso a paso el fichero allí
 * contenido vemos que existen las tres cookies
 */

$r1 = setcookie('usuario', 'Patricia', time() + 5000);
$r2 = setcookie('email', 'patricia@cursoPHP.es', time() + 5000, '/');
$r3 = setcookie('rol', 'admin', time() + 5000, '/pruebasCookies/cookies/directorio_rol');
?>

<!DOCTYPE html>
<html lang="es">
    <head><title>Guardar múltiples cookies</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <head>
    <body>
        <?php
        if ($r1 && $r2 && $r3)
            echo "La petición de la creación de las 3 cookies se envió con éxito";
        else
            echo "No se pudo enviar la petición de la creación de la cookie";
        ?>
    </body>
</html>