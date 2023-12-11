<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>array_walk()</title>
    <link rel="stylesheet" href="../bootstrap.css">
</head>

<?php
class Alumno
{
    private string $nombre;
    private string $apellidos;
    private array $nota;

    public function __construct($nombre, $apellidos, $nota)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->nota = $nota;
    }

    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
        return null;
    }

    public function __set($propiedad, $valor)
    {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
    }
}

$alumnos = [
    new Alumno("Pepe", "Pérez", [10, 3, 4]),
    new Alumno("Juan", "García", [1, 3, 2]),
    new Alumno("Pepe", "Pérez", [2, 3, 5]),
    new Alumno("Juan", "García", [2]),
    new Alumno("Pepe", "Gómez", [2]),
];

function imprimirAlumnos($arr): void
{
    echo "<ul>";
    foreach ($arr as $alumno) {
        echo "<li>" .
            $alumno->__get("nombre") .
            " " .
            $alumno->__get("apellidos") .
            ": ";
        foreach ($alumno->__get("nota") as $nota) {
            echo $nota . " ";
        }
        echo "</li>";
    }
    echo "</ul>";
}

function subirNotas(array &$alumnos, string $nombre): void
{
    array_walk($alumnos, function ($alumno) use ($nombre) {
        if ($alumno->__get("nombre") === $nombre) {
            $notas = $alumno->__get("nota");
            array_walk($notas, function (&$nota) {
                if ($nota < 10) {
                    $nota++;
                }
            });
            $alumno->__set("nota", $notas);
        }
    });
}
?>

<body class="container" >
<h1>array_walk()</h1>
<article>
    <h2>Crear un array de 4 objetos tipo Alumno</h2>
    <p>Escribir una función que suba un punto a aquellos alumnos cuyo nombre sea 'Pepe' utilizando array_walk.</p>
    <p>La clase Alumno no puede tener propiedades públicas (supone crear los métodos __get y __set)</p>
    <p>Las propiedades de los alumnos son nombre, apellidos y nota</p>
    <h3>Notas originales</h3>
    <?php imprimirAlumnos($alumnos); ?>

    <h4>Notas subidas</h4>
    <?php subirNotas($alumnos, "Pepe"); ?>

    <?php imprimirAlumnos($alumnos); ?>

</article>
</body>

</html>