<?php
session_start();
require('../vendor/autoload.php');
require('../app/Controllers/UserController.php');
use App\Controllers\UserController;

$userController=new UserController();

if(!$userController->isUserLoggedIn()){
    http_response_code(401);
    echo "No existe autenticacion";
    exit;
}

$userController->deactivatesecondfactor();