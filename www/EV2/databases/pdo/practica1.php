<?php
declare(strict_types=1);

$db_config = parse_ini_file(".db");
// NOTA: no podemos usar const directamente dado que e l valor de las constantes debe ser conocido en tiempo de
// compilación
define('MYSQL_USER', $db_config["MYSQL_USER"]);
define('MYSQL_ROOT_PASSWORD', $db_config["MYSQL_ROOT_PASSWORD"]);
define('MYSQL_HOST', $db_config["MYSQL_HOST"]);
define('MYSQL_DB', $db_config["MYSQL_DB"]);
const MYSQL_DSN = "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB;

try {
    $pdo = new PDO(MYSQL_DSN, MYSQL_USER, MYSQL_ROOT_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to: " . MYSQL_DSN;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

$sql = "SELECT  receta.*,
                chef.nombre AS chef_name
        FROM receta LEFT JOIN chef ON receta.cod_chef = chef.codigo";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$columnNames = array_keys($recetas[0]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recetas</title>
</head>

<body>
<h1>Recetas</h1>
<table>
    <tr>
        <?php foreach ($columnNames as $columnName): ?>
            <?php if ($columnName != "cod_chef"): ?>
                <th><?= $columnName ?></th>
            <?php endif; ?>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($recetas as $receta): ?>
        <tr>
            <?php foreach ($receta as $columnName => $columnValue): ?>
                <?php if ($columnName != "cod_chef"): ?>
                    <td><?= $columnValue ?></td>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
</body>
<style>
    body {
        font-family: Verdana, sans-serif;
        font-size: 14px;
        text-align: justify;
    }

    div#contenido {
        width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    div#filtro {
        width: 660px;
    }

    fieldset {
        margin: 0px 0px 0px 23px;
    }

    h1 {
        text-align: left;
        color: grey;
        margin: 1em;
    }

    h2 {
        padding-left: 1em;
        color: rosybrown;
    }

    table {
        margin: 0px 10px 10px;
        background-color: LightGrey;
        border-collapse: collapse;
        border-bottom: maroon 3px solid;
    }

    tr {
        border-top: maroon 3px solid;
    }

    td, th {
        padding: 10px 15px;
        color: maroon;
        text-align: left;
    }

    td a {
        color: SlateGrey;
        text-decoration: none;
    }

    #paginado {
        text-align: left;
        padding-left: 20em;
    }

    .ingredientes {
        padding-left: 3em;
        color: slategrey
    }

    table.edicion {
        border-bottom: 0px;
    }

    table.edicion tr {
        border-top: 0px;
    }

    table.edicion td {
        padding: 5px 10px;
    }

    button {
        margin: 5px;
        padding: 5px 15px;
    }

    input[type="text"] {
        width: 170px;
    }

    p.mensaje {
        color: blue;
        font-style: italic;
    }
</style>
</html>