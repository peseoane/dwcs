<!doctype html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Problema de XSS</title>
    </head>
    <body>
        <!--
        Ejecutar la siguiente línea en la barra del navegador y ver el resultado cuando añado 
        htmlspecialchars en el action o sin él.
        http://localhost/validacionFormularios/1_ProblemaXSS.php/%22%3E%3Cscript%3Ealert('hacked')%3C/script%3E
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        -->
         <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        </form>
    </body>
</html>

