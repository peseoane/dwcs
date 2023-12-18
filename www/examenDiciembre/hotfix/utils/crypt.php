<?php
declare(strict_types=1);

namespace App\Utils;
use Exception;

require sanitizeString();
/**
 * @throws Exception in case weird stuff happens such as hackerman or veteran not knowing the keyboard
 */
function generateHashFromPassword(string $password): string
{
    if (empty($password)) {
        throw new Exception("Password cannot be empty");
    } else if (sanitizeString($password) != $password) {
        throw new Exception("Password contains invalid characters");
    }
    return password_hash($password, PASSWORD_DEFAULT);
}