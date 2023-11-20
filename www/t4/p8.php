<?php declare(strict_types=1);

$cities = [
    'Japón' => 'Tokio',
    'Méjico' => 'Ciudad de Méjico',
    'EEUU' => 'Ciudad de Nueva York',
    'India' => 'Bombay',
    'Corea' => 'Seúl',
    'China' => 'Shanghái',
    'Nigeria' => 'Lagos',
    'Argentina' => 'Buenos Aires',
    'Egipto' => 'Cairo',
    'Gran Bretaña' => 'Londres'
];

function generateOptions($array): string
{
    $options = '';
    foreach ($array as $country => $city) {
        $options .= "<option value='$city'>$city</option>";
    }
    return $options;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Países y Ciudades</title>
</head>
<body>
<form method="post">
    <label for="cities">Selecciona una ciudad:</label>
    <select name="cities" id="cities">
        <?= generateOptions($cities) ?>
    </select>
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cities'])) {
        $selectedCity = $_POST['cities'];

        $selectedCountry = array_search($selectedCity, $cities);

        if ($selectedCountry) {
            echo "La ciudad de $selectedCity pertenece a $selectedCountry.";
        } else {
            echo "No se encontró el país para la ciudad seleccionada.";
        }
    }
}
?>
</body>
</html>