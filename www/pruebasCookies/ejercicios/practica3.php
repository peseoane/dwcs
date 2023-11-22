<?php
declare(strict_types=1);

session_start();

$preferences = $_COOKIE['preferences'] ?? null;

$seatOptions = ['aisle', 'window', 'center'];
$menuOptions = ['vegetarian', 'non-vegetarian', 'diabetic', 'child'];
$airportOptions = ['LHR', 'CDG', 'CIA', 'IBZ', 'SIN', 'HKG', 'MLA', 'BOM'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? null;
    $seat = $_POST['seat'] ?? null;
    $menu = $_POST['menu'] ?? null;
    $airports = $_POST['airports'] ?? [];

    $preferences = [
        'name' => $name,
        'seat' => $seat,
        'menu' => $menu,
        'airports' => $airports,
    ];

    setcookie('preferences', json_encode($preferences), time() + (86400 * 30)); // 86400 = 1 day
    header("Location: practica3.php");
    exit;
}

$preferences = $preferences ? json_decode($preferences, true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Preferences</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <script>
        window.onload = function () {
            const link = document.querySelector('link[href="../../css/bootstrap.css"]');
            const request = new XMLHttpRequest();
            request.open('GET', link.href, true);
            request.onreadystatechange = function () {
                if (request.readyState === 4) {
                    if (request.status === 404) {
                        link.href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css";
                    }
                }
            };
            request.send();
        }
    </script>
</head>
<body class="container">
<h1>Flight Preferences</h1>

<form method="post" action="">
    <label>
        Name:
        <input type="text" name="name" value="<?= $preferences['name'] ?? '' ?>">
    </label>
    <label>
        Seat:
        <select name="seat">
            <?php foreach ($seatOptions as $option): ?>
                <option value="<?= $option ?>" <?= ($preferences['seat'] ?? '') === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>
        Menu:
        <select name="menu">
            <?php foreach ($menuOptions as $option): ?>
                <option value="<?= $option ?>" <?= ($preferences['menu'] ?? '') === $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>
        Airports:
        <?php foreach ($airportOptions as $option): ?>
            <input type="checkbox" name="airports[]" value="<?= $option ?>" <?= in_array($option, $preferences['airports'] ?? []) ? 'checked' : '' ?>><?= $option ?>
        <?php endforeach; ?>
    </label>
    <input type="submit" value="Save Preferences">
</form>
</body>
</html>