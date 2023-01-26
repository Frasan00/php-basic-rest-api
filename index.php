<?php
require __DIR__ . "/UserController.php";

$app = new UserController;
echo $app->listen();
echo $_SERVER['REQUEST_URI'];
echo $_SERVER["REQUEST_METHOD"];
?>