<?php
declare(strict_types=1);

namespace App;

function sanitizeString(string $string): string
{
    return mb_strtolower(trim(htmlspecialchars($string)));
}

function sanitizeEmail(string $email): string
{
    return filter_var($email, FILTER_SANITIZE_EMAIL);
}

function sanitizeInt(int $int): int
{
    return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
}

function sanitizeFloat(float $float): float
{
    return filter_var($float, FILTER_SANITIZE_NUMBER_FLOAT);
}

function sanitizeUrl(string $url): string
{
    return filter_var($url, FILTER_SANITIZE_URL);
}