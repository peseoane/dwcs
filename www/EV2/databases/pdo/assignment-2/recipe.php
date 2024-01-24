<?php
declare(strict_types=1);
require_once "dbUtils.php";

/*
 * Always that you have an "if" with a declaration...is it recommended to declare outside the scope of the "if".
 * Do not deal with stupid errors like "undefined variable" or "undefined index"... declare your variables properly!
 */
$ingredientes = [];
if (isset($_GET["receta_nombre"])) {
    $sqlSentence = "SELECT ingrediente.nombre AS ingrediente_nombre,
                           receta_ingrediente.cantidad AS receta_ingrediente_cantidad
                    FROM receta_ingrediente JOIN ingrediente ON receta_ingrediente.cod_ingrediente = ingrediente.codigo
                    WHERE receta_ingrediente.cod_receta = (SELECT codigo FROM receta WHERE nombre = :receta_nombre)";
    $ingredientes = dbUtils::getInstance()->runQueryAssoc($sqlSentence, [
        "receta_nombre" => $_GET["receta_nombre"],
    ]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recetas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Recetas</h1>
<ol>
    <?php foreach ($ingredientes as $ingrediente): ?>
        <li><?= $ingrediente["ingrediente_nombre"] ?>: <?= $ingrediente[
    "receta_ingrediente_cantidad"
] ?> gramos</li>
    <?php endforeach; ?>
</ol>

<a href="assignment-2.php">Volver</a>

</body>
</html>