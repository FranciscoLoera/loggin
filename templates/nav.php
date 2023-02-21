
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">LOGGIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
      
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if($userController->isUserLoggedIn()): ?>
        <li class="nav-item active">
          <a class="nav-link" href="panel-secondfactor.php">Segundo Factor <span class="sr-only"></span></a>
        <li class="nav-item active">
          <b><a class="nav-link" href="panel.php"><?= $_SESSION['email'] ?> <span class="sr-only"></span></a></b>
          <li class="nav-item active">
          <a class="nav-link" href="api/logout.php">Cerrar secion <span class="sr-only"></span></a>
      <?php else: ?>
        <li class="nav-item active">
          <a class="nav-link" href="register.php">Registrarse <span class="sr-only"></span></a>
        <li class="nav-item active">
          <a class="nav-link" href="login.php">Inicier Secion <span class="sr-only"></span></a>
      <?php endif; ?>
    </ul>
  </div>
</nav>