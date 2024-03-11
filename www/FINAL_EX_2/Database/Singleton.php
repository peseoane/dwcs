<?php
declare(strict_types=1);

namespace Database;

trait Singleton
{
    private static ?object $instance = null;

    public static function getInstance(): object
    {
        if (self::$instance === null) {
            self::$instance = new self();
            error_log("Nueva instancia de " . __CLASS__ . " creada");
        }
        error_log("Instancia de " . __CLASS__ . " recuperada");
        return self::$instance;
    }
}