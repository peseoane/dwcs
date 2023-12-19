<!DOCTYPE html>
<html lang="es">
<head>
    <title>Conversor de Moneda</title>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
</head>
<body>
<h1>Conversor de moneda usando una API en tiempo real (Por probar)</h1>

<form method="post" action="">
    <label for="cantidad">Cantidad:</label>
    <input type="number" step="0.01" id="cantidad" name="cantidad" required><br>

    <label for="moneda_origen">Moneda de origen:</label>
    <select id="moneda_origen" name="moneda_origen" required>
        <option value="USD">Dólares (USD)</option>
        <option value="EUR">Euros (EUR)</option>
    </select><br>

    <input type="submit" value="Convertir">
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST["cantidad"];
    $moneda_origen = $_POST["moneda_origen"];
    $api_key = "dddcf7f251341a0381eaacc8";
    $api_url = "https://v6.exchangerate-api.com/v6/$api_key/latest/$moneda_origen";

    $response = file_get_contents($api_url);
    $data = json_decode($response, true);

    if ($data && $data["result"] == "success") {
        if ($moneda_origen === "USD") {
            $exchange_rate = $data["conversion_rates"]["EUR"];
            $moneda_destino = "EUR";
            $cantidad_convertida = $cantidad * $exchange_rate;
        } else {
            $exchange_rate = $data["conversion_rates"]["USD"];
            $moneda_destino = "USD";
            $cantidad_convertida = $cantidad * $exchange_rate;
        }

        echo "<p>$cantidad $moneda_origen equivale a aproximadamente $cantidad_convertida $moneda_destino.</p>";
    } else {
        echo "<p>Error al obtener la tasa de cambio. Por favor, inténtelo nuevamente más tarde.</p>";
    }
} ?>
</body>
</html>