<!doctype html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Problema de XSS</title>
    </head>
    <body>
        <?php
        if (isset($_POST["comentario"]))
        /*
         * Escribir en la caja de texto la siguiente línea
         * <script>alert("hacked")</script>
         */
        {echo $_POST['comentario'];}
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="comentario" value="">
            <input type="submit" name="submit" value="Submit">
        </form>
    </body>
</html>

