<?php
declare(strict_types=1);

session_start();

$loggedEmail = $_SESSION['loggedEmail'];

// $userData = array_filter($_SESSION['registerUsers'], function ($user) use ($loggedEmail) {
//     return $user['registerEmail'] === $loggedEmail;
// });

$userData = null;
$index = null;
array_walk($_SESSION['registerUsers'], function ($user, $index) use ($loggedEmail, &$userData) {
    if ($user['registerEmail'] === $loggedEmail) {
        $userData = $user;
        echo "Index: " . $index . "\n";
    }
});

var_dump($userData);

if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['newPasswordRepeat'])) {

    $currentPassword = $_POST['currentPassword'];
    $currentHashedPassword = hash('sha256', $currentPassword);
    $newPassword = $_POST['newPassword'];
    $newPasswordRepeat = $_POST['newPasswordRepeat'];
    $newHashedPassword = hash('sha256', $newPassword);

    if ($newHashedPassword === $userData['registerPassword']){
        echo "New password can't be the same as the current password";
    } else if ($newPassword !== $newPasswordRepeat) {
        echo "New password and repeat new password must be the same";
    } else if ($currentHashedPassword !== $userData['registerPassword']) {
        echo "Current password is not correct";
    } else {
        $userData['registerPassword'] = $newHashedPassword;
        $_SESSION['registerUsers'][$index] = $userData;
        echo "Password changed successfully";
    }

    unset($_POST['currentPassword']);
    unset($_POST['newPassword']);

    var_dump($_SESSION['registerUsers']);

}

?>

<!DOCTYPE html>
<html lang="en">

<form method="post">

    <p>Change password for: <?php echo $loggedEmail ?></p>
    <label for="currentPassword">Current password</label>
    <input type="password" name="currentPassword" id="currentPassword">
    <br>
    <label for="newPassword">New password</label>
    <input type="password" name="newPassword" id="newPassword">
    <br>
    <label for="newPasswordRepeat">Repeat new password</label>
    <input type="password" name="newPasswordRepeat" id="newPasswordRepeat">
    <br>
    <input type="submit" value="Change password">


</form>

</html>