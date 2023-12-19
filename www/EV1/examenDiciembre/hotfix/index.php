<?php
declare(strict_types=1);

namespace App;
require "manager.php";
require "templates.php";
require "Warehouse.php";

initSesion();

echo generateTitle("Login");
echo generateLogin();
echo generateTitle("Register");
echo generateRegister();

$mywarehouse = Warehouse::getInstance();
$mywarehouse->generateDummyData(10);
var_dump($mywarehouse->getParts());


/* LAMDAS */

$updateInventory = function (int $quantity): bool {
    $uuids = [];
    $mywarehouse = Warehouse::getInstance();

    foreach ($mywarehouse->getParts() as $part) {
        $uuids[] = $part->getUuid();
    }

    $uuid = $uuids[array_rand($uuids)];

    foreach (&$mywarehouse->getParts() as $part) {
        if ($part->getUuid() === $uuid) {
            $part->setQuantity($quantity);
            return true;
        }
    }

};

$updateInventory(2);
var_dump($mywarehouse->getParts());