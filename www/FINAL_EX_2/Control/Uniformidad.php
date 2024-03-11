<?php
declare(strict_types=1);
namespace Control;

/**
 * Interface para no olvidarme de nada crítico... luego hay una implementación abstracta
 * para quitar sobretodo muchas cosas obsoletas de PHP.
 */
interface Uniformidad
{
    public function __destruct();
    public function __toString(): string;
    public function __serialize(): array;
    public function __unserialize(array $data): void;

}