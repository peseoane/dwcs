<?php

//Ejecutarlo paso a paso

/*
 * El método mágico __isset() se dispara cuando se utiliza los constructores del 
 * lenguaje con  isset() o empty() en propiedades innacesibles (protegidas o 
 * privadas) o inexistentes.
 * El método __toString() se dispara cuando usamos un objeto como una string, por
 * ejemplo con echo, print() o printf(). Este método nos permite decidir cómo 
 * reaccionará el objeto cuando lo tratamos como string
 * El método mágico __unset() se dispara cuando utilizamos unset() en propiedades 
 * NO existentes o propiedades inaccesibles (protected o private)
 * El método mágico __invoke() se dispara cuando utilizamos un objeto como una función
 */

class Usuario
{
    /*
     * Contador va a ser una variable de clase (estática) porque queremos saber el 
     * número de individuos que hay de esa clase y esta variable estática se irá asignando 
     * como identificador cada vez que se cree un objeto o se clone
     */

    static private int $contador = 0;
    public array $info = [
        'nombre' => '',
        'edad'   => 0,
    ];
    private int $id;
    /*
     * La siguiente variable la declaro como pública para probar el comportamiento de 
     * __isset() pero debería ser private para encapsular
     */
    private int | float $salario;

    public function __construct($salario = 0, $datos = ["", 0])
    {
        /*
         * Las tres palabras claves especiales self, parent y static son utilizadas para 
         * acceder a propiedades y métodos desde el interior de la definición de la clase. 
         */
        $this->salario = $salario;
        $this->id = self::$contador++; //postdecremento
        $this->info['nombre'] = $datos[0];
        $this->info['edad'] = $datos[1];
    }

    public function __clone()
    {
        $this->id = self::$contador++;
    }

    public function __isset($nombre)
    {
        $devol = false;
        if (array_key_exists($nombre, $this->info)) {
            if ($this->info[$nombre] != "")
                $devol = true;
        }
        return $devol;
    }

    public function __unset($campo)
    {
        unset($this->info[$campo]);
    }

    /*
     * Como la clase tiene un array, la traducción a string no es directa por lo que
     * conviene implementar el método mágico __toString()
     */

    public function __toString()
    {
        return "<br>El usuario con id: " . $this->id . " y nombre: " . $this->info['nombre'] . " con " . $this->info['edad'] . " años, salario " . $this->salario . "<br>";
    }

    public function __invoke($salario, $nombre, $edad)
    {
        //No puedo llamar al constructor porque modificaría el id y el contador
        $this->salario = $salario;
        $this->info['nombre'] = $nombre;
        $this->info['edad'] = $edad;
    }
}

$salario = 35000;
$datos_persona = ['Alfonso', 34];
$persona1 = new Usuario($salario, $datos_persona);
/*
 * Intenta acceder a la prop innacesible nombre (ya que está dentro de un array)
 * aunque la hayamos declarado como pública. 
 * Se produce un fallo si comento la función __isset() porque al no encontrar esa 
 * propiedad no clona el objeto y se produce un notice indicando que $user2 es 
 * una variable indefinida
 */
if (isset($persona1->nombre))
    $usuario_clonado = clone $persona1;
//Llama a __toString
echo "<b>Los datos del primer usuario son </b>$persona1<br>";
//LLama a __toString
echo "<b>Los datos del segundo usuario tras clonar son </b>$usuario_clonado<br>";

//Creo un usuario sin datos
$persona_sin_inicializar = new Usuario();

/*
 * Llama al método mágico __invoke. Se dispara cuando se llama a un objeto como
 * una función. Puede hacerse de dos formas:
 * Usando una instancia del objeto
 * Utilizando call_user_func_array
 * 
 * Comentar una de las dos siguientes líneas para ver cómo se puede ejecutar
 * de las dos formas.
 */

//$persona_sin_inicializar(40000, 'Yago', 27);
call_user_func_array($persona_sin_inicializar, [40000, 'Yago', 27]);

echo "<b>Los datos de la persona que se creó con invoke </b>" . $persona_sin_inicializar;
//Çomo es una propiedad innacesible entra dentro de unset y borra el índice asociado
// al array de datos
echo "<br><b>Los datos de la persona sin borrar nada</b>";
var_dump($persona1);

//Llama al método mágico __unset()
unset($persona1->edad);
//No existe la siguiente propiedad y no hace nada
unset($persona1->incentivos);
echo "<b>Tras borrar la edad y e intentar borrar incentivos del primer usuario " . "creado tenemos el siguiente objeto</b>";
var_dump($persona1);