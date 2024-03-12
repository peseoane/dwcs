<?php
declare(strict_types=1);
namespace Alumno;
use Exception;
use TypeError;

trait OrdenarTrait {
    public function ordenar(): void {
        try {
            usort($this->cursos, function($a, $b) {
                return $b['nota'] <=> $a['nota'];
            });
        } catch (TypeError $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}