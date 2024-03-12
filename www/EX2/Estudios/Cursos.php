<?php
declare(strict_types=1);

namespace Cursos;

class Curso extends BaseAcademy
{
    protected static int $id = 0;
    protected string $especialidad;
    protected NIVEL_DIFICULTAD $nivelDificultad;

    public function __construct(string $nombre, string $direccion, CURSO_LECTIVO $curso, string $especialidad, NIVEL_DIFICULTAD $nivelDificultad)
    {
        parent::__construct($nombre, $direccion, $curso);
        $this->especialidad = $especialidad;
        $this->nivelDificultad = $nivelDificultad;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function getEspecialidad(): string
    {
        return $this->especialidad;
    }

    public function getNivelDificultad(): NIVEL_DIFICULTAD
    {
        return $this->nivelDificultad;
    }

    public function setEspecialidad(string $especialidad): void
    {
        $this->especialidad = $especialidad;
    }

    public function setNivelDificultad(NIVEL_DIFICULTAD $nivelDificultad): void
    {
        $this->nivelDificultad = $nivelDificultad;
    }

    public function __toString(): string
    {
        return "Curso: " . $this->nombre . " - " . $this->direccion . " - " . $this->curso . " - " . $this->especialidad . " - " . $this->nivelDificultad;
    }

    public function __clone()
    {
        return new Curso(
            '',
            $this->direccion,
            $this->curso,
            $this->especialidad,
            NIVEL_DIFICULTAD::INTERMEDIO,
        );
    }

}