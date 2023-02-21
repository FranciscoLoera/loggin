<?php
include './templates/header.php';

if(!$userController->isUserLoggedIn()){
    header('Location: login.php');
}
$user=$userController->getUser();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>LOGIN</title>
</head>
<body>
    <?php include './templates/nav.php'?>
    <div class="container mt-5">
    <?php if($user['admin']===0):?>
        <h3>Panel de Usuario</h3><hr>
    <?php else:?>
        <h3>Panel de Administrador</h3><hr>
    <?php endif;?>
    </div>
</body>
</html>