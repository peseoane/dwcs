<?php
declare(strict_types=1);

namespace Alumno;

use ArrayAccess;
use Cursos\Curso;
use Override;
use TypeError;

class Alumno implements ArrayAccess
{
    use OrdenarTrait;

    private string $nombre;
    private array $cursos = [];

    public function __construct(string $nombre, array $cursos)
    {
        $this->nombre = $nombre;
        $this->cursos = $cursos;
    }

    public function getCursos(): array
    {
        return $this->cursos;
    }

    public function setCurso(array $cursos): void
    {
        $this->cursos = $cursos;
    }


    #[Override] public function offsetExists(mixed $offset): bool
    {
        return isset($this->cursos[$offset]);
    }

    #[Override] public function offsetGet(mixed $offset): mixed
    {
        return $this->cursos[$offset];
    }

    #[Override] public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($value instanceof Curso) {
            if (is_null($offset)) {
                $this->cursos[] = $value;
            } else {
                $this->cursos[$offset] = $value;
            }
        } else {
            throw new TypeError("El valor asignado no es una instancia de Curso");
        }
    }

    #[Override] public function offsetUnset(mixed $offset): void
    {
        unset($this->cursos[$offset]);
    }
}