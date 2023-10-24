<?php
if (isset($_GET['message'])) {
    $message = urldecode($_GET['message']);
    echo '<div class="alert alert-warning m-0 text-center">'.htmlspecialchars($message).'</div>';
}

if (isset($_GET['success-message'])) {
    $message = urldecode($_GET['success-message']);
    ?>
      <div id="success-alert" class="alert alert-success m-0 text-center w-25 d-flex justify-content-center h-25 position-fixed top-50 start-50 translate-middle z-3 flex-column">
        <p class="text-center w-100 fw-bolder"><?=htmlspecialchars($message)?></p>
        <a class="btn btn-success mt-5" href="/migocwb/resources/views/auth/login.php">Ok</a>
      </div>
    <?php
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/style/auth/globals.css">
    <link rel="stylesheet" href="../../public/style/auth/styledAuth.css">

    <title>Login</title>
</head>
<body>
  <main class="main">
        <div class="left-login">
          <div class="logo-img-container">
            <img src="../../public/img/logo.png" class="logo-img">
          </div>
          <div class="btn-container">
            <a href="./newRegister.php">
                <h2><button class="register-btn-fill hvr-grow">CADASTRE-SE</button></h2>
            </a>
          </div>
        </div>
        <div class="right">
          <div class="form-container">
            <form action="" class="form">
                <h1 class="login-title">Login</h1>
              
               <div class="input-container">
                  <label for="email" class="form-label">E-mail</label>
                  <input type="email" class="form-input" name="email" id="email" placeholder="E-mail">
                </div>
              <div class="input-container">
                  <label for="password" class="form-label">Senha</label>
                  <input type="password" class="form-input" name="password" id="password" placeholder="Senha">
                </div>
                <div class="btn-container">
                  <h2><button class="login-btn hvr-grow">ENTRAR</button></h2>
              </div>
              <div class="mobile-link">
                  <h6>Não possui uma conta? <a href="./newRegister.php"><h2 class="register-link">Cadastre-se</h2></a></h6>
                </div>
            </form>
          </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../public/js/globals.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   </div>
  </body>
  </html>
