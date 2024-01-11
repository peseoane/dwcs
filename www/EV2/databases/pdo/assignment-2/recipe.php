<?php
declare(strict_types=1);
require_once "dbUtils.php";
$pdo = (new dbUtils(".db"))->getPdo();

if (isset($_GET["receta_nombre"])) {
    // Table ingrediente and receta are linked by the table receta_ingrediente
    $sqlSentence = "SELECT ingrediente.nombre AS ingrediente_nombre,
                           receta_ingrediente.cantidad AS receta_ingrediente_cantidad
                    FROM receta_ingrediente JOIN ingrediente ON receta_ingrediente.cod_ingrediente = ingrediente.codigo
                    WHERE receta_ingrediente.cod_receta = (SELECT codigo FROM receta WHERE nombre = :receta_nombre)";
    $stmt = $pdo->prepare($sqlSentence);
    $stmt->execute(["receta_nombre" => $_GET["receta_nombre"]]);
    $ingredientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <li><?= $ingrediente["ingrediente_nombre"] ?>: <?= $ingrediente["receta_ingrediente_cantidad"] ?> gramos</li>
    <?php endforeach; ?>
</ol>

<a href="assignment-2.php">Volver</a>

</body>
</html>