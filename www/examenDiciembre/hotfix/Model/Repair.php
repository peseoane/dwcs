<?php
declare(strict_types=1);

namespace App\Model;

class Repair
{
    private static $id = 0;
    private string $qualifiedIdentifier;
    private string $description;
    private string $date;
    private string $operatorName;
    private array $partsUsed;

    public function __construct(string $qualifiedIdentifier, string $description, string $date, string $operatorName)
    {
        $this->id = self::$id++;
        $this->qualifiedIdentifier = $qualifiedIdentifier;
        $this->description = $description;
        $this->date = $date;
        $this->operatorName = $operatorName;
        $this->partsUsed = [];
    }

    public function addPartToRepair(Part $part): bool
    {
        try {
            $this->partsUsed[] = $part;
            return true;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getUUIDusedParts(): array
    {
        $uuids = [];
        foreach ($this->partsUsed as $part) {
            $uuids[] = $part->getUUID();
        }
        return $uuids;
    }

}