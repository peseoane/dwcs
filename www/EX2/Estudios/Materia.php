<?php
declare(strict_types=1);

namespace Cursos;

use Interfaces\CamnbioMateria as LocalCambiarMateria;
use Cursos\Autoincrement as Autoincrement;

class Materia extends BaseAcademy implements LocalCambiarMateria
{
    use Autoincrement;
    protected string $cicloFormativo;
    protected Curso $curso;
    protected CURSO_LECTIVO $curso_lectivo;
    private static int $id = 0;

    public function __construct(
        string        $nombre,
        string        $direccion,
        CURSO_LECTIVO $curso_lectivo,
        string        $cicloFormativo,
        Curso         $curso
    )
    {
        parent::__construct($nombre, $direccion, $curso_lectivo);
        $this->cicloFormativo = $cicloFormativo;
        $this->curso = $curso;
        self::autoincrement();
    }

    #[\Override] public function cambiarMateria(string $materia): void
    {
        $this->curso->setEspecialidad($materia);
    }
}