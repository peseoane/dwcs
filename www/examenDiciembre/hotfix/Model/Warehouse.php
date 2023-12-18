<?php
declare(strict_types=1);

namespace App\Model;

use Exception;
use Inventory;
use Override;
use Singleton;

class Warehouse implements Inventory
{
    use Singleton;

    // Due to PHP not supporting multiple inheritance, we use a trait to implement the Singleton pattern

    private const string IDENTIFIER = "Handling buffer";
    private array $parts;
    private int $partsCount;

    public function __construct()
    {
        $this->parts = [];
    }

    #[Override] public function addPartToWarehouse(Part $part): bool
    {
        try {
            $this->parts[] = $part;
            $this->partsCount++;
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    #[Override] public function deletePartFromWarehouse(Part $part): bool
    {
        try {
            $this->parts = array_diff($this->parts, [$part]);
            $this->partsCount--;
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }


    #[Override] public function getPartsCountByPartName(string $partName): int
    {
        $count = 0;
        foreach ($this->parts as $part) {
            if ($part->getPartName() === $partName) {
                $count++;
            }
        }
        return $count;
    }

    public function bulkRemovePartsFromWarehouse(array $uuids): bool
    {
        $result = false;
        foreach ($uuids as $uuid) {
            $result = $this->deletePartFromWarehouseByUUID($uuid);
        }
        return $result;
    }

    #[Override] public function deletePartFromWarehouseByUUID(string $uuid): bool
    {
        foreach ($this->parts as $part) {
            if ($part->getUUID() === $uuid) {
                $this->parts = array_diff($this->parts, [$part]);
                $this->partsCount--;
                return true;
            }
        }
        return false;
    }
}