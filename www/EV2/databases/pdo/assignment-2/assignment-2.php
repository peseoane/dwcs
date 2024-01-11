<?php
declare(strict_types=1);
/**
 * ASSIGNMENT 2 :: PDO
 * SEOANE PRADO, PEDRO VICENTE
 * CREATED: 31/12/2023
 * REV:     11/01/2024
 */

require_once "dbUtils.php";

// Apparantly, in PHP we need to cast the object first to be able to be called, probably because interpreted gibberish..
$pdo = (new dbUtils(".db"))->getPdo();

// Using the previous table as a reference, we need to show the recipe, difficulty, ETA and chef name
// when clicking on the recipe name, we need to show the ingredients and the steps to cook it.

$sqlSentence = "SELECT receta.nombre AS receta_nombre,
                       receta.dificultad AS receta_dificultad,
                       receta.tiempo AS receta_tiempo,
                       chef.nombre AS chef_nombre
                FROM receta JOIN chef ON receta.cod_chef = chef.codigo";

$stmt = $pdo->prepare($sqlSentence);
$stmt->execute();
$recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// When clicking on the recipe, a GET request is sent to the server with the recipe name as a parameter, and returns the HTML.
// We're going to replace the $columnName === "receta_nombre" with a link to the recipe page.

$recetas = array_map(function ($receta) {
    $receta["receta_nombre"] = "<a href='recipe.php?receta_nombre=" . $receta["receta_nombre"] . "'>" . $receta["receta_nombre"] . "</a>";
    return $receta;
}, $recetas);

// A query for the chefs NOMBRE APELLIDO NOMBRE ARTISTICO but next column we're gonna add to the GET endpoint a route
// to edit the chef registration.

$sqlSentence = "SELECT chef.codigo,
       chef.nombre, 
       chef.apellido1,
       chef.apellido2, 
       chef.nombreartistico 
FROM chef";
$stmt = $pdo->prepare($sqlSentence);
$stmt->execute();
$chefs = $stmt->fetchAll(PDO::FETCH_ASSOC);
// I'm lazy
$chefs = array_map(function ($chef) {
    $chef["apellidos"] = $chef["apellido1"] . " " . $chef["apellido2"];
    return $chef;
}, $chefs);
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