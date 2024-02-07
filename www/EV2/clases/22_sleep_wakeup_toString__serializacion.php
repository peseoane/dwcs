
<?php

class Conexion {

    protected $link;
    private $servidor, $bd, $usuario, $contrasenha;

    public function __construct($servidor = "localhost", $usuario = "admin", $contrasenha = "", $bd = "") {
        $this->servidor = $servidor;
        $this->bd = $bd;
        $this->usuario = $usuario;
        $this->contrasenha = $contrasenha;
        $this->connect();
    }

    public function connect() {
        $this->link = new PDO('mysql:host=' . $this->servidor . ';base=' .
                $this->bd, $this->usuario, $this->contrasenha);
    }

    public function __sleep() {
        /*
         * __sleep() se ejecuta antes de una serialización. Devuelve un array con los
         * nombres de los campos que representan el estado del objeto que queremos almacenar.
         * No tiene sentido almacenar un puntero a una zona de memoria. Porque cuando lo
         * queramos recuperar la conexión a ese elemento no tiene sentido.
         */


        return array('servidor', 'bd', 'usuario', 'contrasenha');
    }

    public function __set($atributo, $valor) {
        if (property_exists(__CLASS__, $atributo)) {
            $this->$atributo = $valor;
        } else {
            echo "No existe el atributo $atributo.";
        }
    }

    public function __wakeup() {
        //__wakeup() está destinado a restablecer las conexiones de base de datos
        //que se puedan haber perdido durante la serialización y realizar otras
        //tareas de reinicialización. 

        $this->connect();
    }

    public function __toString() {
        return "Servidor= " . $this->servidor . ", Base de datos= " . $this->bd .
                ", Usuario= " . $this->usuario . ", contraseña= " . $this->contrasenha;
    }

}

$objeto = new Conexion("localhost", "root", "", "pedidos");
/*
 * La función serialize() genera una representación almacenable de un valor, 
 * incluyendo su tipo y estructura. Por ejemplo:
 * String
 * s:size:value;
 * Integer
 * i:value;
 * Boolean
 * b:value; (No almacena "true" o "false", almacena '1' o '0')
 * Array
 * a:size:{definición de la clave;definición del valor;(repetido por cada elemento)}
 * Es útil para almacenar valores en PHP sin perder su tipo y estructura
 * 
 * Además la función serialize() llama al método mágico __sleep()
 */
$str = serialize($objeto);
echo "Serialización del objeto de la conexión a la base de datos prueba <br><b>$str </b><br>";
//$array_nueva_BD = array("bd" => "empleados", "usuario" => "root", "contrasenha" => "");
$array_nueva_BD = array("bd" => "empleados");

/*
 * $objeto2 va a ser un objeto de tipo Connection y exactamente igual a $objeto,
 * tras ejecutar la función de unserialize(), que va a crear el link a la BBDD de pedidos
 */
$objeto2 = unserialize($str);
foreach ($array_nueva_BD as $ind => $valor) {
    $objeto2->{$ind} = $valor;
}
/*
 * Tenemos $objeto2 con datos de la BBDD empleados pero el link a la de pedidos.
 * Tras ejecutar el método connect() creará el link adecuadamente 
 */
$objeto2->connect();
echo "<br>Segundo objeto con cambio de base de datos <b>$objeto2</b>";
?>
