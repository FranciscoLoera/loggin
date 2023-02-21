<?php
include './templates/header.php';

if(!$userController->isUserLoggedIn()){
    header('Location: login.php');
}

//segundo factor
$user=$userController->getUser();

$hasTwoFactorActive=true;
if($user['two_factor_key']===null){
    $hasTwoFactorActive=false;
    $g=new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
    $secret=$g->generateSecret();
    $qrCode= \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($user['name'],$secret,"LOGGIN");
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

    <?php if(!$hasTwoFactorActive):?>

        <div class="container mt-5">
            <h5>Activar doble factor de Autenticación</h5><hr>  
            <p>
                1- Para activar el doble factor de atenticación, instale Google Authenticator en su dispositivo movil
            </p>
            <img src="<?=$qrCode?>" alt="Codigo qr">

            <p class="mt-4">2- Escriba el codigo generado por Google Authenicator y pulse en boton "Activar doble factor"</p>

            <div class="row">
            <div class="col-md-4">
                <form id="activate-second-factor">
                    <div class="form-group">
                        <label for="ccodigo">Codigo</label>
                        <input type="text" class="form-control" id="code">
                    </div>
                    <button type="submit" class="btn btn-primary">Activar doble factor</button>
                </form>
                <div class="alert alert-danger mt-4 d-none" id="error-mesage"></div>
            </div>
        </div>
        </div>
    <?php else:?>
        <div class="container mt-5">
            <h5>Desactivar doble factor de Autenticación</h5><hr> 
            <button type="button" class="btn btn-primary" id="deactivate-second-factor">Desactivar doble factor</button>
        </div>
    <?php endif;?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

    <?php if(!$hasTwoFactorActive):?>
        <script>
            document.getElementById("activate-second-factor").onsubmit=(e)=>{
                e.preventDefault();

                const errorMessage=document.getElementById("error-mesage");
                errorMessage.classList.add('d-none');
                const code=document.getElementById('code').value;
                const secret='<?=$secret?>';

                if(!code||!secret){
                    return;
                }

                axios.post('api/activateseceondfactor.php', {code:code,secret:secret}).then(res=>{
                    
                    window.location='panel-secondfactor.php';

                }).catch(err=>{
                    errorMessage.innerText=err.response.data;
                    errorMessage.classList.remove('d-none');
                    //console.log(err.response.data);
                });
            };
        </script>
    <?php else:?>
        <script>
            document.getElementById('deactivate-second-factor').onclick=(e)=>{
                e.preventDefault();
                axios.post('api/deactivateseceondfactor.php').then(res=>{
                    window.location='panel-secondfactor.php';
                });
            }
        </script>
    <?php endif;?>
    
</body>
</html>