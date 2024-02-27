<?php
spl_autoload_register(function ($clase) {
    //Esta primera línea hay que incluirla porque el namespace puede ser compuesto
    //y por tanto llevar \ o / y así lo indipendizamos del Sistema operativo
    $clase = str_replace('\\', DIRECTORY_SEPARATOR, $clase);
    $fichero = __DIR__ . DIRECTORY_SEPARATOR . "clases" . DIRECTORY_SEPARATOR . $clase . '.php';
    if (file_exists($fichero)) {
        require $fichero;
    } else
        echo "Fichero no existe";
});
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 2</title>
    </head>
    <body>
        <?php
        $nom = "Patricia";
        $nif = "123456789Z";
        $direc = "Vigo";
        $web = "www.cursoPHP.es";
        $mail = "patricia@google.com";
        $telf = "123456789";
        $fechaIniGrupo = "";
        $base = new Base($nom, $nif, $direc);
        echo $base->show();
        $grupo = new Grupos($nom, $nif, $direc, $web);
        echo $grupo->show();
        $participante = new Participantes($nom, $nif, $direc, $mail, $telf, $grupo, $fechaIniGrupo);
        echo $participante->show();
        ?>
    </body>
</html>
