<?php declare(strict_types=1);

require "./navigator/bootstrap.php";

$cssResource = new Resource(ResourceType::CSS);
$jsResource = new Resource(ResourceType::JS);

echo $cssResource->inject();
echo $jsResource->inject();