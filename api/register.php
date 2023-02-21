<?php
session_start();
require('../vendor/autoload.php');
require('../app/Controllers/UserController.php');
use App\Controllers\UserController;


$rawData= file_get_contents("php://input");
$data=json_decode($rawData, true);

$userController=new UserController();
$id=$userController->register($data['name'],$data['email'],$data['password']);

if($id===0){
    http_response_code(400);
    echo "Ya esxistes un ususario registrado con este email";
}else{
    //iniciar secion
    $userController->login($data['email'],$data['password']);
    http_response_code(200);
    echo $id;
}