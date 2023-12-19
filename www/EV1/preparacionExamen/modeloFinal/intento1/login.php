<?php
declare(strict_types=1);

require "User.php";
require "utils.php";
function addToSession(string $key, $value): void
{
    $_SESSION[$key][] = $value;
}

session_start();
if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])) {
    try {
        $localUser = new User(
            normaliceFormField($_POST["loginEmail"]),
            normaliceFormField($_POST["loginPassword"])
        );
        addToSession("registerUsers", $localUser);
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        var_dump($e->getMessage());
    }

    header("Location: Pedro_Seoane.php");
}
