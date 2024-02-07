<?php

//Ejecutar paso a paso
abstract class Calculo {

    abstract public function calcular();
    /*
     * El método __callStatic se llama cuando intentamos llamar a métodos
     * innacesibles (privados o protegidos) o inexistentes en un contexto 
     * estático (por medio del operador ::)
     */

    // public static __callStatic ( string $name , array $arguments ) : mixed

    public static function __callStatic($operacion, $op) {

        if ($operacion == "Suma")
            $aux = $op[0] + $op[1];
        else if ($operacion == "Resta")
            $aux = $op[0] - $op[1];
        else
            $aux = "<br><b>Operación no soportada</b>";
        return $aux;
    }

    private static function Calcular_potencia($op1, $op2) {
        return pow($op1, $op2);
    }

}

$op1 = 3;
$op2 = 2;
//Podemos llamar a un método de modo estático de una clase abstracta
//Se dispara el método mágico __callStatic pues no existe el método Suma
echo "El resultado sumar $op1 y $op2 es " . Calculo::Suma($op1, $op2);
/*
 * En la siguiente sentencia no se llama al método calcular_potencia porque es 
 * inaccesible (privado)
 */
echo "<br>El resultado de elevar $op1 a $op2 es " . Calculo::Calcular_potencia($op1, $op2);
?>