<?php
include './templates/header.php';
if($userController->isUserLoggedIn()){
    header('Location: panel.php');
}

if(isset($_SESSION['isLoggedIn']) && !$_SESSION['isLoggedIn']){
    $userController->logout();
}

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
        <div class="row justify-content-md-center">
            <div class="col col-md-6">
                <h3>Login</h3><hr>
                <form id="login-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email"  placeholder="email">
                    </div>
                    <div class="form-group">
                        <label for="passeord">Password</label>
                        <input type="password" class="form-control" id="pass" placeholder="password">
                    </div> 
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
                <div class="alert alert-danger mt-4 d-none" id="error-mesage">

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script>
        document.getElementById("login-form").onsubmit=(e)=>{
            e.preventDefault();

            const errorMessage=document.getElementById("error-mesage");
            errorMessage.classList.add('d-none');
            const email=document.getElementById('email').value;
            const password=document.getElementById('pass').value;

            if(!email||!password){
                return;
            }

            axios.post('api/login.php', {email:email,password:password}).then(res=>{
                if(res.data.secondfactor){
                    window.location='login-secondfactor.php';
                }else{
                    window.location='panel.php';
                }
                

            }).catch(err=>{
                errorMessage.innerText=err.response.data;
                errorMessage.classList.remove('d-none');
                //console.log(err.response.data);
            });
        };
    </script>
</body>
</html>