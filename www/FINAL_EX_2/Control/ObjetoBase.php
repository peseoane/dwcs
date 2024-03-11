<?php

namespace Control;

use Exception;

/**
 * Esta clase es para que, cuando implementemos la interfaz Uniformidad, no tengamos que implementar los métodos mágicos.
 * Puesto que están obsoletos y así ya acarreamos el error por todas las clases.
 */
abstract class ObjetoBase implements \Serializable
{
    public function __destruct()
    {
        error_log("Instancia de " . __CLASS__ . " destructora");
    }

    /**
     * @throws Exception
     */
    #[\Override] public function serialize()
    {
        error_log("Método obsoleto");
        throw new Exception("Método obsoleto");
    }

    /**
     * @throws Exception
     */
    #[\Override] public function unserialize(string $data)
    {
        error_log("Método obsoleto");
        throw new Exception("Método obsoleto");
    }
}