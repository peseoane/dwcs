<?php declare(strict_types=1);

class CuentaBancaria
{
    private array $pesoEntidadSucursal;
    private array $pesoNumCuenta;

    public function __construct(
        array $pesoEntidadSucursal,
        array $pesoNumCuenta
    ) {
        $this->pesoEntidadSucursal = $pesoEntidadSucursal;
        $this->pesoNumCuenta = $pesoNumCuenta;
    }

    public function codigoCuentaCorrecto(array $cuenta): bool
    {
        $numCuenta = array_slice($cuenta, 10, 10);

        $digitoControlNumCuenta = $this->calcularDigitoControl(
            $numCuenta,
            $this->pesoNumCuenta
        );

        return $cuenta[9] == $digitoControlNumCuenta;
    }

    private function calcularDigitoControl(array $parteCuenta, array $peso): int
    {
        $sumaPonderada = 0;
        foreach ($parteCuenta as $key => $digito) {
            $sumaPonderada += $digito * (int) $peso[$key];
        }

        $resto = $sumaPonderada % 11;
        $resultado = 11 - $resto;

        return $resultado == 11 || $resultado == 10 ? 0 : $resultado;
    }
}

// Definir los pesos
$pesoEntidadSucursal = [4, 8, 5, 10, 9, 7, 3, 6];
$pesoNumCuenta = [1, 2, 4, 8, 5, 10, 9, 7, 3, 6];

// Crear una instancia de la clase CuentaBancaria
$cuentaBancaria = new CuentaBancaria($pesoEntidadSucursal, $pesoNumCuenta);

// Definir la cuenta bancaria proporcionada
$cuentaProporcionada = str_split("ES3020805027223040030810");

// Verificar si la cuenta es correcta
$esCorrecta = $cuentaBancaria->codigoCuentaCorrecto($cuentaProporcionada);

// Imprimir el resultado
echo $esCorrecta ? "La cuenta es correcta." : "La cuenta no es correcta.";
?>
