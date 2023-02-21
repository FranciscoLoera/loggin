<?php
include './templates/header.php';
if($userController->isUserLoggedIn()){
    header('Location: panel.php');
}

if (!(isset($_SESSION['isLoggedIn'])) && isset($_SESSION['email'])) {
    header('Location: login.php');
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
                <h3>Segundo factor de autenticación</h3><hr>
                <form id="second-factor-form">
                    <div class="form-group">
                        <label for="codigo">Codigo</label>
                        <input type="text" class="form-control" id="code" >
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
        document.getElementById("second-factor-form").onsubmit=(e)=>{
            e.preventDefault();

            const errorMessage=document.getElementById("error-mesage");
            errorMessage.classList.add('d-none');
            const code=document.getElementById('code').value;

            if(!code){
                return;
            }

            axios.post('api/logisecondfactor.php', {code:code}).then(res=>{
                
                window.location='panel.php';

            }).catch(err=>{
                errorMessage.innerText=err.response.data;
                errorMessage.classList.remove('d-none');
                //console.log(err.response.data);
            });
        };
    </script>
</body>
</html>