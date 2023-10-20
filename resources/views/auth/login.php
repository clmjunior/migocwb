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
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="../../public/js/scripts.js"></script>
        <link rel="stylesheet" href="./styledAuth.css">
        <title>Login</title>
        
    </head>
    <body class="overflow-hidden">
        <div class="main-login ">
            <div class="left-login">
                <h1>Conheça agora esta comunidade!</h1>
                <img class="left-login-image" src="../../public/img/logo.png" alt="">
            </div>
            <div class="right-login">
                <div class="card-login">
                    <h1>LOGIN</h1>

                    <!-- FORMULARIO DE LOGIN -->
                    <form action="../../../controllers/form_handler.php?action=authenticate" method="POST">
                        <div class="textfield">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="textfield">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" placeholder="Senha" required>
                        </div>
                        <button type="submit" name="adiciona" value="adiciona" class="btn-login">Entrar</button>
                    </form>
                    <div class="col-12 centralizar">
                        <a href="#" class="link-primary">
                            <p class="text-center">Esqueceu a senha?</p>
                        </a>
                    </div>
                    <div class="col-6 centralizar">
                        <button type="button" class="btn btn-success btn-xl col-12 btn-criarconta" data-bs-toggle="modal" data-bs-target="#exampleModal">Criar Conta</button>
                    </div>
                </div>
            </div>
            <?php

                // INCLUINDO FORMULARIO DE REGISTRO DO USUARIO
                include_once("./registration.php");
            ?>
        </div>
    </body>
</html>
