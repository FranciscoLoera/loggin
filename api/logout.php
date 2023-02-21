<?php
session_start();
require('../vendor/autoload.php');
require('../app/Controllers/UserController.php');

$userController=new App\Controllers\UserController();
$userController->logout();

header('Location: ../login.php');