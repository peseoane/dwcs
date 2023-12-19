<?php
declare(strict_types=1);
namespace App;

interface Inventory
{
    public function addPartToWarehouse(Part $part): bool;

    public function deletePartFromWarehouse(Part $part): bool;

    public function deletePartFromWarehouseByUUID(string $uuid): bool;

    public function getPartsCountByPartName(string $partName): int;
}