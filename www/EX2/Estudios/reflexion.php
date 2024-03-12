<?php
class MyClass  {


    public static int $id = 0;
    public $foo;
    private $bar;
    protected $baz;

}

$reflect = new ReflectionClass('MyClass');
$properties = $reflect->getProperties();

var_dump($properties);

foreach ($properties as $property) {
    var_dump($property->getName()) ;
}