<?php
declare(strict_types=1);

interface Inventory
{
    public function addPartToWarehouse(\App\Model\Part $part): bool;

    public function deletePartFromWarehouse(\App\Model\Part $part): bool;

    public function deletePartFromWarehouseByUUID(string $uuid): bool;

    public function getPartsCountByPartName(string $partName): int;
}