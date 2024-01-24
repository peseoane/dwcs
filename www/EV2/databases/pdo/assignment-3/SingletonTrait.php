<?php
declare(strict_types=1);

/**
 * The difference between this trait and the old class, is that the trait is "copy-pasted" into the class that uses it.
 * This way, we can use the trait in multiple classes, and we don't need to extend a class to use it.
 */
trait SingletonTrait
{
    private static ?self $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}
