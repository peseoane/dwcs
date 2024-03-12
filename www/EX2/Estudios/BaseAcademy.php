<?php
declare(strict_types=1);

namespace Cursos;


abstract class BaseAcademy
{


    protected string $nombre;
    protected string $especialidad;
    protected float $nota;

    public function __construct(string $nombre, string $direccion, CURSO_LECTIVO $curso)
    {
        self::$id++;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->curso = $curso;
    }

    public function __destruct()
    {
        self::$id--;
    }

}