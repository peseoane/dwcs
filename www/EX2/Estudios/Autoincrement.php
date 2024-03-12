<?php

namespace Cursos;
trait Autoincrement
{

    public function autoincrement(): void
    {
        self::$id++;
    }

    public function getID(): int
    {
        return self::$id;
    }

    public function setID(int $id): void
    {
        self::$id = $id;
    }
}