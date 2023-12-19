<?php
declare(strict_types=1) ?>
<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Edad</title>
</head>
<body>
<form method="post">
    <label for="dob">Fecha de Nacimiento:</label>
    <input type="date" id="dob" name="dob" required>
    <input type="submit" value="Calcular Edad">
</form>
</body>
</html>
<?php
class AgeCalculator
{
    public function calculateAge(string $dateOfBirth): array
    {
        $today = new DateTime("now");
        $dob = new DateTime($dateOfBirth);

        $diff = $today->diff($dob);

        return [
            "years" => $diff->yPe,
            "months" => $diff->m,
            "days" => $diff->d,
        ];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["dob"])) {
        $dob = $_POST["dob"];

        $timestamp = strtotime($dob);
        if ($timestamp === false) {
            echo "Por favor, introduce una fecha válida.";
        } else {
            $calculator = new AgeCalculator();
            $age = $calculator->calculateAge($dob);

            echo "Edad: " .
                $age["years"] .
                " años, " .
                $age["months"] .
                " meses, " .
                $age["days"] .
                " días.";
        }
    }
}


?>
