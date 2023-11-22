<?php
declare(strict_types=1);

session_start();

if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = [];
}

$_SESSION['visits'][] = date('Y-m-d H:i:s');

$visits = $_SESSION['visits'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visit Tracker</title>
</head>
<body>
<h1>Visit Tracker</h1>

<h2>Previous Visits</h2>
<ul>
    <?php foreach ($visits as $visit): ?>
        <li><?= $visit ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>