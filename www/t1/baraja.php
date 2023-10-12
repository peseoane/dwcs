<?php

class Baraja
{
    private $path = "./assets/baraja/";
    private $cartas = [];

    public function __construct()
    {
        $this->loadDeck();
    }

    private function loadDeck(): void
    {
        $cardFiles = glob($this->path . '*.png');
        foreach ($cardFiles as $cardFile) {
            $this->cartas[] = $cardFile;
        }
    }

    public function shuffleDeck(): void
    {
        shuffle($this->cartas);
    }

    public function SsrHtmlShuffleDeck(): void
    {
        foreach ($this->cartas as $carta) {
            echo '<img src="' . $carta . '" alt="Card" class="img-fluid">';
        }
    }
}

$baraja = new Baraja();
$baraja->shuffleDeck();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Seoane Prado, Pedro Vicente">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.css">
    <title>Baraja de cartas</title>
</head>

<body class="container p-4">
<article>
    <h1>Baraja de cartas</h1>
    <section>
        <h2>Ejercicio</h2>
        <p>Utiliza matrices para almacenar una lista de cartas de baraja española como la siguiente.</p>
        <img class="img-fluid" src="./Baraja_española.PNG" alt="Baraja española">
        <p>Después de representar la baraja ordenada en la matriz, desordena aleatoriamente a matriz (barajar) y muestra
            en
            la web a lista de cartas.</p>
        <p> Para ello utiliza las imágenes que se te proporcionan en el fichero adjunto.</p>
    </section>
    <section>
        <h2>Solución</h2>
        <div class="d-flex justify-content-center align-items-center p-4">
            <button class="btn btn-primary" onclick="window.location.reload()">Barajar</button>
        </div>
        <div class="container p-4">
            <?php
            $baraja->SsrHtmlShuffleDeck();
            ?>
        </div>
    </section>
</article>
<footer class="p-4">
    <div class="container-fluid text-center">Seoane Prado, Pedro Vicente</div>
</footer>
</body>
</html>