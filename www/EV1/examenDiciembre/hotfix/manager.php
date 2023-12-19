<?php
declare(strict_types=1);
namespace App;

/* SESSION HANDLING */

function initSesion()
{
    if (!isSessionStarted()){
        startSession();
    } else if (!isSessionEmpty()){
        $_SESSION = [];
        $_SESSION['warehouse'] = new Warehouse().generateDummyData(10);
    }
}

function deleteSession(): void {
    session_unset();
    session_destroy();
}

function startSession(): void {
    session_start();
}

function isSessionStarted(): bool {
    return session_status() === PHP_SESSION_ACTIVE;
}

function isSessionEmpty(): bool {
    return empty($_SESSION);
}

function isSessionSet(string $key): bool {
    return isset($_SESSION[$key]);
}

function getSessionValue(string $key) {
    return $_SESSION[$key];
}

function setSessionValue(string $key, $value): void {
    $_SESSION[$key] = $value;
}

function deleteSessionValue(string $key): void {
    unset($_SESSION[$key]);
}

/** FILE HANDLING */

function getColCsvToArray(string $path, int $col): array {
    $file = fopen($path, "r");
    // convert from windows 1252 to utf-8
    stream_filter_append($file, 'convert.iconv.Windows-1252/UTF-8');
    $array = [];
    while (($data = fgetcsv($file)) !== false) {
        $array[] = $data[$col];
    }
    fclose($file);
    return $array;
}