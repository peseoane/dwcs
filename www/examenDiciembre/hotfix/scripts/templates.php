<?php
declare(strict_types=1);

function generateTitle(string $title): string {
    return <<<EOT
    <h1>$title</h1>
    <br>
    EOT;
}

function generateLogin(): string {
    return <<<EOT
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <br>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <br>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="Login">
        <br>
    </form>
    EOT;

}

function generateRegister(): string {
    return <<<EOT
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <br>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <br>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="password2">Repeat password:</label>
        <br>
        <input type="password" name="password2" id="password2" required>
        <br>
        <input type="submit" value="Register">
        <br>
    </form>
    EOT;
}



function generateLogout(): string {
    return <<<EOT
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
    EOT;
}