<?php

include_once 'Autoload.php';

use Database\SqlBuilder;

$builder = SqlBuilder::getInstance();

var_dump($builder);

$res = $builder->withQueryAndParams("SELECT * FROM evento WHERE id = :id", ["id" => 1]);

var_dump($res);