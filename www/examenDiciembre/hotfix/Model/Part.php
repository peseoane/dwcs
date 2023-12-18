<?php
declare(strict_types=1);

namespace App\Model;
use function App\Utils\sanitizeString;

require "..\utils\sanitize.php";

class Pieza {

    private string $uuid;
    private string $partName;

    public function __construct(string $partName) {
        $this->uuid = uniqid();
        $this->partName = sanitizeString($partName);
    }


}