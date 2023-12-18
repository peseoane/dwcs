<?php
declare(strict_types=1);

class Pieza
{

    private int $idPieza;

    private string $nombrePieza;
    private int $numUnidadesPieza;
    private bool $actualizado;



    /**
     * @param int $idPieza Por el momento supondemos que es para una FK por tanto int i32.
     * @param string $nombrePieza
     * @param int $numUnidadesPieza
     */
    public function __construct(int $idPieza, string $nombrePieza, int $numUnidadesPieza)
    {
        $this->idPieza = $idPieza;
        $this->nombrePieza = $nombrePieza;
        $this->numUnidadesPieza = $numUnidadesPieza;
    }

    public function getIdPieza(): int
    {
        return $this->idPieza;
    }

    public function setIdPieza(int $idPieza): Pieza
    {
        $this->idPieza = $idPieza;
        return $this;
    }

    public function getNombrePieza(): string
    {
        return $this->nombrePieza;
    }

    public function setNombrePieza(string $nombrePieza): Pieza
    {
        $this->nombrePieza = $nombrePieza;
        return $this;
    }

    public function getNumUnidadesPieza(): int
    {
        return $this->numUnidadesPieza;
    }

    public function setNumUnidadesPieza(int $numUnidadesPieza): Pieza
    {
        $this->numUnidadesPieza = $numUnidadesPieza;
        return $this;
    }

    public function isActualizado(): bool
    {
        return $this->actualizado;
    }

    public function setActualizado(bool $actualizado): Pieza
    {
        $this->actualizado = $actualizado;
        return $this;
    }

}