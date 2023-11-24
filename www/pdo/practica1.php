<?php
declare(strict_types=1);

const MYSQL_USER = 'dwcs';
const MYSQL_ROOT_PASSWORD = 'dwcs';
const MYSQL_HOST = 'mysql8';
const MYSQL_DB = 'dwcs';
CONST MYSQL_DSN = 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB;

try {
    $pdo = new PDO(MYSQL_DSN, MYSQL_USER, MYSQL_ROOT_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected successfully to: ' . MYSQL_DSN;
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}