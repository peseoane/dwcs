<?php
declare(strict_types=1);
require_once "dbUtils.php";

/**
 * ASSIGNMENT 2 :: PDO
 * SEOANE PRADO, PEDRO VICENTE
 * CREATED: 31/12/2023
 * REV:     15/01/2024
 */

# $pdo = (new dbUtils(".db"))->getPdo(); // too java-ish
$pdo = dbUtils::getInstance()->getPdo();

$sqlSentence = "SELECT receta.nombre AS receta_nombre,
                       receta.dificultad AS receta_dificultad,
                       receta.tiempo AS receta_tiempo,
                       chef.nombre AS chef_nombre
                FROM receta JOIN chef ON receta.cod_chef = chef.codigo";

$recetas = dbUtils::getInstance()->runQueryAssoc($sqlSentence);
$recetas = array_map(function ($receta) {
    $receta["receta_nombre"] = "<a href='recipe.php?receta_nombre=" . $receta["receta_nombre"] . "'>" . $receta["receta_nombre"] . "</a>";
    return $receta;
}, $recetas);

$sqlSentence = "SELECT chef.codigo,
       chef.nombre, 
       chef.apellido1,
       chef.apellido2, 
       chef.nombreartistico 
FROM chef";

$chefs = dbUtils::getInstance()->runQueryAssoc($sqlSentence);

// Because I'm too lazy to type two words
$chefs = array_map(function ($chef) {
    $chef["apellidos"] = $chef["apellido1"] . " " . $chef["apellido2"];
    return $chef;
}, $chefs);

// Don't do this crap at home, kids, this is not async friendly and will hurt your feelings later on
$chefs = array_map(function ($chef) {
    unset($chef["apellido1"]);
    unset($chef["apellido2"]);
    return $chef;
}, $chefs);

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
<table>
    <tr>
        <?php foreach (array_keys($recetas[0]) as $columnName): ?>
            <th><?= $columnName ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($recetas as $receta): ?>
        <tr>
            <?php foreach ($receta as $columnName => $columnValue): ?>
                <td><?= $columnValue ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Listado de cocineros</h1>
<table>
    <tr>
        <?php foreach (array_keys($chefs[0]) as $columnName): ?>
            <th><?= $columnName ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($chefs as $chef): ?>
        <tr>
            <?php foreach ($chef as $columnName => $columnValue): ?>
                <?= $columnName === "codigo" ? "" : "<td>{$columnValue}</td>" ?>
            <?php endforeach; ?>
            <td><a href="chefs.php?chef_codigo=<?= $chef["codigo"] ?>">Editar</a></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>