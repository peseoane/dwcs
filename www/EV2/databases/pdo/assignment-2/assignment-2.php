<?php
declare(strict_types=1);
require_once "dbUtils.php";

/**
 * ASSIGNMENT 2 :: PDO
 * SEOANE PRADO, PEDRO VICENTE
 * CREATED: 31/12/2023
 * REV:     15/01/2024
 */

$sqlSentence = "SELECT receta.nombre AS 'Receta',
                       receta.dificultad AS 'Dificultad',
                       receta.tiempo AS 'Tiempo',
                       chef.nombre AS 'Chef'
                FROM receta JOIN chef ON receta.cod_chef = chef.codigo";
/*
 * We don't create a new object of dbUtils because we are using the singleton pattern.
 * So, we call the static method getInstance() to get the instance of the class.
 * Singleton will take care of creating the object if it doesn't exist for us.
 */

$recetas = dbUtils::getInstance()->runQueryAssoc($sqlSentence);

/*
 * Now we are going to modify the array of recetas to add a link to each recipe.
 */
$recetas = array_map(function ($receta) {
    $receta["Receta"] =
        "
      <a href='recipe.php?receta_nombre=" .
        $receta["Receta"] .
        "'>" .
        $receta["Receta"] .
        "
      </a>";
    return $receta;
}, $recetas);

/*
 * Now we are going to get the list of chefs.
 */
$sqlSentence = "SELECT chef.codigo,
       chef.nombre AS 'Nombre',
       chef.apellido1,
       chef.apellido2, 
       chef.nombreartistico AS 'Nombre artístico'
FROM chef";

/*
 * Again, we don't create a new object of dbUtils because we are using the singleton pattern.
 */
$chefs = dbUtils::getInstance()->runQueryAssoc($sqlSentence);

// If you look closely, apellido1 and apellido2 will need to be concatenated.
$chefs = array_map(function ($chef) {
    $chef["apellidos"] = $chef["apellido1"] . " " . $chef["apellido2"];
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
            <?= $columnName === "codigo" ? "" : "<th>{$columnName}</th>" ?>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($chefs as $chef): ?>
        <tr>
            <?php foreach ($chef as $columnName => $columnValue): ?>
                <?= $columnName === "codigo" ? "" : "<td>{$columnValue}</td>" ?>
            <?php endforeach; ?>
            <!-- ¿Did you notice that we are passing the chef's code as a GET parameter? to the future ENDPOINT
            that will be the chef's edition page called chefs.php?chef_codigo=PARAM ? -->
            <td><a href="chefs.php?chef_codigo=<?= $chef[
                "codigo"
            ] ?>">Editar</a></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>