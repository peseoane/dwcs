<?php
declare(strict_types=1);

class Inventario
{
    private array $piezas;

    /**
     * @param array $piezas
     */
    public function __construct(array $piezas)
    {
        $this->piezas = $piezas;
    }

    public function getPiezas(): array
    {
        return $this->piezas;
    }

    public function setPiezas(array $piezas): void
    {
        $this->piezas = $piezas;
    }
}
