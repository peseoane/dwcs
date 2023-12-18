<?php
declare(strict_types=1);
require "scripts/manager.php";
require "scripts/templates.php";

startSession();

echo generateTitle("Login");
echo generateLogin();
echo generateTitle("Register");
echo generateRegister();