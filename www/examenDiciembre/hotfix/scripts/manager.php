<?php
declare(strict_types=1);

function deleteSession(): void {
    session_unset();
    session_destroy();
}

function startSession(): void {
    session_start();
}