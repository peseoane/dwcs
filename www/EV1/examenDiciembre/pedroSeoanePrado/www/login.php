<?php
declare(strict_types=1);

require './Utils.php';

$authHash = hash('sha256', '1234');

session_start();

if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {

    $isAuthValid = false;
    /**
     * $sanitazedEmail = filter_input(INPUT_POST,$_POST['loginEmail'],FILTER_VALIDATE_EMAIL);
     * $sanitazedPassword = filter_input(INPUT_POST, $_POST['loginPassword'],FILTER_SANITIZE_SPECIAL_CHARS);
     */
    $localSubmitedEmail = trim(htmlspecialchars($_POST['loginEmail']));
    $hashedSubmitedPasword = hash('sha256', trim(htmlspecialchars($_POST['loginPassword'])));

    if (!isset($_SESSION['intentos'])) {
        $_SESSION['intentos'] = 0; // RESET ACU
        header("Location: index.php");
    } else if ($_SESSION['intentos'] >= 3) {
        $_SESSION['msg'] = "Login blocked (More than 3 attemps!)";
        header("Location: msg.php");
    } else if ($hashedSubmitedPasword === $authHash) {
        $isAuthValid = true;
        $_SESSION['auth'] = $isAuthValid;
        $_SESSION['msg'] = "Login successful";
        $_SESSION['intentos'] = 0; // RESET ACU

        error_log("USUARIO AUTENTICADO -> REDIRIGIENDO AL PANEL");
        setcookie('loggedEmail', $_POST['loginEmail'], time() + 3600); // Ignorar path dejar auto
        header("Location: reparaciones.php");
    } else {
        $_SESSION['auth'] = $isAuthValid;
        $_SESSION['msg'] = "Wrong password, doesn't match";
        $_SESSION['intentos'] = $_SESSION['intentos'] + 1;
        error_log('');
        header('Location: msg.php'); // leeré de sesion si auth is valid
    }
}