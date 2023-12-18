<?php
declare(strict_types=1);

require './Pieza.php';
require './Inventario.php';

function leerUltimoCodigoDeReparacion(): int
{
    session_start();
    if (!isset($_SESSION['reparaciones'])) {
        $_SESSION['reparaciones'] = array();
    }
    return count($_SESSION['reparaciones']);
}

function generarDatosDummy(int $iteraciones): array
{
    $dummyData = array();
    for ($i = 0; $i < $iteraciones; $i++) {
        $pieza = new Pieza(rand(1024, 2048), uniqid(), rand(1, 10));
        $dummyData[] = $pieza;
    }
    $dummyData[] = new Pieza(10, 'Tornillo', 10);
    $dummyData[] = new Pieza(20, "Rosca", 20);
    return $dummyData;
}

function checkForItem(array $inventario, int $codigo, int $cantidad): mixed
{
    $status = false;
    foreach ($inventario as $item) {
        if ($codigo === $item->getIdPieza() && $cantidad <= $item->getNumUnidadesPieza()) {
            $status = true; // ¿Actualizo el inventario con qué?... no se especifica, pondré un booleano
            // me invento una propiedad
            $item->setActualizado(true);
            return $inventario;
        }
    }
    return $status;
}


// FUNCION PARA GESTIONAR VARIABLES SERVIDOR
// En mi caso, aunque NO me ha dado tiempo el enfoque es que hay clases por composicion de piezas a reparaciones
// Y usariamos una sesión a modo de almacén tal que: pero no dio tiempo a implementar.

function manageSession(string $name, mixed $data): void
{
    $_SESSION[$name] = $data;
}

function manageCookie(string $name, mixed $data): void
{
    setcookie($name, serialize($data), time() + 3600);
}