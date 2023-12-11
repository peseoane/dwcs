<?php
echo "<h2>OP1</h2>";

$test_data = [
    "string",
    1.994,
    0,
    mb_strtoupper("Alistate en la Marina", "UTF-8"),
    null,
];

function process_array(&$array, $callback, $increment)
{
    foreach ($array as &$value) {
        if (is_array($value)) {
            $value = process_array($value, $callback, $increment);
        } else {
            $value = is_numeric($value)
                ? $callback($value, $increment)
                : $callback($value);
            var_dump($value);
            echo "\n";
        }
    }
}

function apply_function($item, $increment = null)
{
    return is_numeric($item) ? $item + $increment : strrev($item);
}

process_array($test_data, "apply_function", 10);

/*
 * PHP is a horrible language. It's made out of a web page, a broken C++ clone, a bad comic book, and a heap of bad design decisions.... fuck this shit
 */

echo "<h2>OP2</h2>";

$data = [
    "cadena",
    1.994,
    0,
    mb_strtoupper("Alistate en la Marina", "UTF-8"),
    null,
];

$procesador = new class {
    function procesar(&$array, $callback, $increment)
    {
        array_walk_recursive($array, function (&$value) use (
            $callback,
            $increment
        ) {
            $value = is_numeric($value)
                ? $callback($value, $increment)
                : strrev($callback($value));
            var_dump($value);
            echo "\n";
        });
    }
};

$procesador->procesar(
    $data,
    fn($item, $increment = null) => is_numeric($item)
        ? $item + $increment
        : strrev($item),
    10
);
