<?php

declare(strict_types=1);

class WeatherForm
{
    private array $conditions = [
        "soleado",
        "nublado",
        "lluvia",
        "granizo",
        "aguanieve",
        "nieve",
        "viento",
        "frío",
        "calor",
        "neblina",
        "humedad",
    ];

    public function generateCheckboxes(): string
    {
        $checkboxes = "";
        foreach ($this->conditions as $condition) {
            $checkboxes .=
                '<input type="checkbox" name="weather[]" value="' .
                strtolower($condition) .
                '">';
            $checkboxes .= ucfirst($condition) . "<br>";
        }
        return $checkboxes;
    }

    public function atLeastOneChecked(): bool
    {
        if (!empty($_POST["weather"])) {
            return true;
        }
        return false;
    }

    public function displayList(string $data): string
    {
        $items = explode(",", $data);
        $list = "<ul>";
        foreach ($items as $item) {
            $list .= "<li>" . ucfirst(trim($item)) . "</li>";
        }
        $list .= "</ul>";
        return $list;
    }

    public function validateAndConvertMonth($month): string
    {
        if (is_numeric($month) && $month >= 1 && $month <= 12) {
            return date("F", mktime(0, 0, 0, (int) $month, 1));
        } elseif (is_string($month) && strtotime($month)) {
            $month = date("n", strtotime($month));
            return date("F", mktime(0, 0, 0, (int) $month, 1));
        } else {
            return ""; // Si no es un mes válido, devolver cadena vacía
        }
    }
}

$weatherForm = new WeatherForm();
$errorMessage = "";
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = $_POST["city"] ?? "";
    $month = $_POST["month"] ?? "";
    $year = $_POST["year"] ?? "";

    $monthName = $weatherForm->validateAndConvertMonth($month);

    if (empty($city) || empty($month) || empty($year)) {
        $errorMessage =
            "Por favor, complete todos los campos requeridos: Ciudad, Mes y Año.";
    } elseif ($monthName === "") {
        $errorMessage =
            "Ingrese un mes válido (número del 1 al 12 o nombre del mes en formato válido).";
    } else {
        if (!$weatherForm->atLeastOneChecked()) {
            $errorMessage =
                "Registro inválido. Se debe marcar al menos una condición atmosférica.";
        } else {
            $weather = implode(",", $_POST["weather"] ?? []);
            $additionalInfo = $_POST["additionalInfo"] ?? "";

            $data = $weather . "," . $additionalInfo;
            $result = $weatherForm->displayList($data);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro del Tiempo Atmosférico</title>
</head>

<body>
<form method="post">
    <label for="city">Ciudad:</label>
    <input type="text" id="city" name="city" required>

    <label for="month">Mes:</label>
    <input type="text" id="month" name="month" required>

    <label for="year">Año:</label>
    <input type="text" id="year" name="year" type="number" required>

    <?= $weatherForm->generateCheckboxes() ?>

    <label>¿Quiere añadir algo más?</label>
    <input type="radio" id="yes" name="additionalInfoOption" value="yes" onclick="showAdditionalInfo()">
    <label for="yes">Sí</label>
    <input type="radio" id="no" name="additionalInfoOption" value="no" onclick="hideAdditionalInfo()" checked>
    <label for="no">No</label>

    <textarea id="additionalInfo" name="additionalInfo" size="60" style="display: none;"></textarea>

    <input type="submit" value="Enviar">
</form>

<script>
    function showAdditionalInfo() {
        document.getElementById('additionalInfo').style.display = 'block';
    }

    function hideAdditionalInfo() {
        document.getElementById('additionalInfo').style.display = 'none';
    }
</script>

<?php if (!empty($errorMessage)): ?>
    <p><?= $errorMessage ?></p>
<?php elseif (!empty($result)): ?>
    <p>En la ciudad de <?= $city ?> en <?= $monthName ?> de <?= $year ?> Vd. observó las siguientes condiciones
        atmosféricas:</p>
    <?= $result ?>
<?php endif; ?>
</body>

</html>