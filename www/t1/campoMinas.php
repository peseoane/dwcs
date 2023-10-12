<?php
class CampoMinas {
    
    private int $dimension;
    private array $vector;

    public function __construct(int $orden) {
        $this->dimension = $orden;
        $this->populateVector();
        $this->fillMines();
    }
    
    private function populateVector(): void {
        $this->vector = array_fill(0, $this->dimension, array_fill(0, $this->dimension, '.'));
    }
    
    private function fillMines(): void {
        $filledMine = 0;
        while ($filledMine < 10) {
            $i = rand(0, $this->dimension - 1);
            $j = rand(0, $this->dimension - 1);
            if ($this->vector[$i][$j] !== '*') {
                $this->vector[$i][$j] = '*';
                $filledMine++;
            }
        }
    }

    public function toString(): void {
        for ($i = 0; $i < $this->dimension; $i++) {
            for ($j = 0; $j < $this->dimension; $j++) {
                echo $this->vector[$i][$j] . ' ';
            }
            echo "<br>";
        }
    }
}

$campoMinas = new CampoMinas(20);

$campoMinas->toString();