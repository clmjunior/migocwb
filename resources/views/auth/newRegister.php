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
        <div class="left-register">
          <div class="logo-img-container">
            <img src="../../public/img/logo.png" class="logo-img">
          </div>
          <div class="btn-container">
            <a href="./new-login.php">
                <h2><button class="login-btn-fill hvr-grow">ENTRE</button></h2>
            </a>
          </div>
        </div>
        <div class="right">
          <div class="form-container">
            <form action="" class="form">
                <h1 class="register-title">Cadastro</h1>
                <div class="d-flex w-100">
                    <div class="input-container w-50 pe-2">
                        <label for="Name" class="form-label">Nome</label>
                        <input type="Name" class="form-input" Name="Name" id="Name" placeholder="Nome">
                    </div>
                    <div class="input-container w-50 ps-2">
                        <label for="LastName" class="form-label">Sobrenome</label>
                        <input type="LastName" class="form-input" name="LastName" id="LastName" placeholder="Sobrenome">
                    </div>
                </div>
                <div class="input-container">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-input" name="email" id="email" placeholder="E-mail">
                </div>
                <div class="d-flex w-100">
                    <div class="input-container w-50 pe-2">
                        <label for="Password" class="form-label">Senha</label>
                        <input type="Password" class="form-input" name="Password" id="Password" placeholder="Senha">
                    </div>
                    <div class="input-container w-50 ps-2">
                        <label for="ConfirmPassword" class="form-label">Confirmar Senha</label>
                        <input type="ConfirmPassword" class="form-input" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirmar Senha">
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="input-container w-75 pe-2">
                        <label for="CEP" class="form-label">CEP</label>
                        <input type="CEP" class="form-input" name="CEP" id="CEP" placeholder="CEP">
                    </div>
                    <div class="input-container w-25 ps-2">
                        <label for="Number" class="form-label">Número</label>
                        <input type="Number" class="form-input" name="Number" id="Number" placeholder="Número">
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="input-container w-25 pe-2">
                        <label for="UF" class="form-label">UF</label>
                        <input type="UF" class="form-input" name="UF" id="UF" placeholder="UF">
                    </div>
                    <div class="input-container w-75 ps-2">
                        <label for="City" class="form-label">Cidade</label>
                        <input type="City" class="form-input" name="City" id="City" placeholder="Cidade">
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="input-container w-50 pe-2">
                        <label for="Neighborhood" class="form-label">Bairro</label>
                        <input type="Neighborhood" class="form-input" name="Neighborhood" id="Neighborhood" placeholder="Bairro">
                    </div>
                    <div class="input-container w-50 ps-2">
                        <label for="Street" class="form-label">Rua</label>
                        <input type="Street" class="form-input" name="Street" id="Street" placeholder="Rua">
                    </div>
                </div>
                <div class="btn-container">
                  <h2><button class="register-btn hvr-grow">CADASTRAR</button></h2>
                </div>
                <div class="mobile-link">
                  <h6>Já possui uma conta? <a href="./new-login.php"><h2 class="login-link">Entrar</h2></a></h6>
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
