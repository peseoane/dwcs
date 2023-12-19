<?php
declare(strict_types=1);

require "User.php";

function initSession(): bool
{
    try {
        session_start();
        if (!isset($_SESSION["registerUsers"])) {
            $_SESSION["registerUsers"] = [];
            $tmpPassword = uniqid();
            $_SESSION["registerUsers"][] = new User(
                "admin@admin.es",
                $tmpPassword
            );
            error_log("root password is: " . $tmpPassword);
        }
        return true;
    } catch (Exception $localException) {
        error_log("initSession: " . var_dump($localException->getMessage()));
        return false;
    }
}

function existsUser(string $email, string $hashedPassword): bool
{
    try {
        $exists = false;
        array_walk($_SESSION["registerUsers"], function ($user) use (
            $email,
            $hashedPassword,
            &$exists
        ) {
            if (
                $user->getEmail() == $email &&
                $user->getHashedPassword() == $hashedPassword
            ) {
                $exists = true;
            }
        });
        return $exists;
    } catch (Exception $localException) {
        error_log("existsUser: " . $email);
        error_log("existsUser: " . var_dump($localException->getMessage()));
        return false;
    }
}

function getUserIndex(User $user): int
{
    try {
        $index = -1;
        array_walk($_SESSION["registerUsers"], function ($localUser, $key) use (
            $user,
            &$index
        ) {
            if (
                $localUser->getEmail() == $user->getEmail() &&
                $localUser->getHashedPassword() == $user->getHashedPassword()
            ) {
                $index = $key;
            }
        });
        return $index;
    } catch (Exception $localException) {
        error_log("getUserIndex: " . $user->getEmail());
        error_log("getUserIndex: " . var_dump($localException->getMessage()));
        return -1;
    }
}

function updateUser(User $user): bool
{
    try {
        $index = getUserIndex($user);
        if ($index != -1) {
            $_SESSION["registerUsers"][$index] = $user;
            return true;
        }
        return false;
    } catch (Exception $localException) {
        error_log("replaceUser: " . $user->getEmail());
        error_log("replaceUser: " . var_dump($localException->getMessage()));
        return false;
    }
}

function normaliceFormField(string $field): string
{
    try {
        error_log("normaliceFormField: " . $field);
        return trim(
            stripslashes(htmlspecialchars($field, ENT_QUOTES, "UTF-8"))
        );
    } catch (Exception $localException) {
        return "ERROR -> " . var_dump($localException->getMessage());
    }
}

function validateEmail(string $email): bool
{
    try {
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    } catch (Exception $localException) {
        error_log("validateEmail: " . $email);
        error_log("validateEmail: " . var_dump($localException->getMessage()));
        return false;
    }
}
