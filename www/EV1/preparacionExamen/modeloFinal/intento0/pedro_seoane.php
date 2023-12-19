<?php
declare(strict_types=1);

session_start();
$init = function () {
    if (!isset($_SESSION["registerUsers"])) {
        $_SESSION["registerUsers"] = [];
    }
};

// Main loop
// $checkUser = function (array $submitedRegistration, array $registeredUsers): bool {
//     foreach ($registeredUsers as $registeredUser) {
//         if (isset($registeredUser['registerEmail']) === $submitedRegistration['tmpRegisterEmail']) {
//             return true;
//         }
//     }
//     return false;
// };

$checkUser = function (
    array $submitedRegistration,
    array &$registeredUsers
): bool {
    $found = false;
    array_walk($registeredUsers, function ($registeredUser) use (
        $submitedRegistration,
        &$found
    ) {
        if (
            isset($registeredUser["registerEmail"]) &&
            $submitedRegistration["tmpRegisterEmail"] ===
                $registeredUser["registerEmail"]
        ) {
            $found = true;
        }
    });
    return $found;
};

$init();
if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])) {
    $email = $_POST["loginEmail"];
    $password = $_POST["loginPassword"];
    $hashedPassword = hash("sha256", $password);

    $found = false;
    array_walk($_SESSION["registerUsers"], function ($registeredUser) use (
        $email,
        $hashedPassword,
        &$found
    ) {
        if (
            $registeredUser["registerEmail"] === $email &&
            $registeredUser["registerPassword"] === $hashedPassword
        ) {
            $found = true;
        }
    });

    if ($found) {
        $_SESSION["loggedEmail"] = $email;
        header("Location: pedro_seoane_login.php");
        echo "Login correcto";
    } else {
        echo "Login incorrecto";
    }

    var_dump($_SESSION);
} elseif (isset($_POST["registerEmail"]) && isset($_POST["registerPassword"])) {
    $email = $_POST["registerEmail"];
    $password = $_POST["registerPassword"];

    $tmpRegisterUser = [
        "uniqueId" => uniqid(),
        "tmpRegisterEmail" => $email,
        "tmpRegisterPassword" => hash("sha256", $password),
    ];

    if ($checkUser($tmpRegisterUser, $_SESSION["registerUsers"])) {
        error_log("Usuario ya registrado", 0);
        echo "Usuario ya registrado";
    } else {
        echo "Usuario registrado correctamente";
        $_SESSION["registerUsers"][] = [
            "uniqueId" => $tmpRegisterUser["uniqueId"],
            "registerEmail" => $tmpRegisterUser["tmpRegisterEmail"],
            "registerPassword" => $tmpRegisterUser["tmpRegisterPassword"],
        ];
        unset($tmpRegisterUser); // memory clean! :) (not sure if it's necessary)
    }
    var_dump($_SESSION);
} elseif (isset($_POST["reset"])) {
    session_unset();
    session_destroy();
    header("pedro_seoane.php");
} else {
    //log it
    error_log("POST vacio, recargando...", 0);
    header("pedro_seoane.php");
}
?>
<html>
<head>
    <title>Examen 1ª EV - Modelo 1</title>
    <meta charset="UTF-8">
    <meta viewport="width=device-width, initial-scale=1.0">
</head>

<body>
<h1>Examen 1ª EV - Modelo 1</h1>
<h2>Pedro Seoane</h2>

<table>
    <tr>
        <h2>LOGIN</h2>
        <form method="post">
            <label for="loginEmail">Email</label>
            <input type="email" name="loginEmail" id="loginEmail" required>
            <br>
            <label for="loginPassword">Password</label>
            <input type="password" name="loginPassword" id="loginPassword" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </tr>
    <tr>
        <h2>REGISTER</h2>
        <form method="post">
            <label for="email">Email</label>
            <input type="email" name="registerEmail" id="registerEmail" required>
            <br>
            <label for="password">Password</label>
            <input type="password" name="registerPassword" id="registerPassword" required>
            <br>
            <label for="password-validate">Repeat Password</label>
            <input type="password" name="registerPassword-validate" id="registerPassword-validate" required>
            <br>
            <input type="submit" value="Register">
        </form>
    </tr>
    <tr>

        <form method="post">
            <input type="submit" name="reset" value="Reset">
        </form>
    </tr>
</table>
</body>
</html>