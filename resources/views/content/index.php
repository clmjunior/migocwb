<?php

require_once('../../../controllers/UserController.php');
require_once('../../../controllers/EventController.php');
require('../../../controllers/Functions.php');
require_once(__DIR__ . '../../../../db/conn.php');

session_start();
$oFunc = new Functions;

if (!$_SESSION['id']) {
  $message = 'Você deve efetuar o login para visualizar o conteudo!';
  header('Location: ../auth/login.php?message=' . urlencode($message));
  exit;

} else {
  $conn = getDBConnection();
  if($conn) {

    $oUser = new User($conn);
    $user = $oUser->getUser($_SESSION['id']);

    $oEvent = new Event($conn);
    $events = $oEvent->getEvents($user['id']);
  }

}

if (isset($_GET['message'])) {
  $message = urldecode($_GET['message']);
  echo '<div class="alert alert-warning m-0 text-center">'.htmlspecialchars($message).'</div>';
}

if (isset($_GET['success-message'])) {
  $message = urldecode($_GET['success-message']);
  ?>
    <div class="overlay"></div>
    <div id="success-alert" class=" alert alert-success m-0 text-center w-25 d-flex justify-content-center h-25 position-fixed top-50 start-50 translate-middle z-3 flex-column">
      <p class="text-center w-100 fw-bolder"><?=htmlspecialchars($message)?></p>
      <button class="btn btn-success mt-5" onclick="goBack()">Ok</button>
    </div>
  <?php
}

if (isset($_GET['error-message'])) {
  $message = urldecode($_GET['error-message']);
  ?>
    <div class="overlay"></div>
    <div id="success-alert" class="alert alert-danger m-0 text-center w-25 d-flex justify-content-center h-25 position-fixed top-50 start-50 translate-middle z-3 flex-column">
      <p class="text-center w-100 fw-bolder"><?=htmlspecialchars($message)?></p>
      <button class="btn btn-danger mt-5" onclick="goBack()">Ok</button>
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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../../public/style/globals.css"/>
      <link rel="stylesheet" type="text/css" href="../../public/style/content/styledContent.css"/>
      <link rel="stylesheet" type="text/css" href="../../public/style/content/modals/styledContentModals.css"/>
      <script src="../../public/js/scripts.js"></script>
      <title>MigoCWB</title>
  </head>
  <body class="d-flex flex-column">

      <header>
        <!-- NAVBAR -->
        <nav class="navbar">
            <div class="navbar-logo-container">
              <a href="./index.php" class="hvr-opacity">
                <img src="../../public/img/logo-img.png" class="nav-logo" alt="..." >
                <img src="../../public/img/colored-logo-text.png" class="nav-logo-text" alt="..." >
              </a>
            </div>

            <form class="searchbar-container" role="search">
              <div class="searchbar">
                <input type="search" placeholder="Pesquisar Eventos" class="form-input search-input" aria-label="Search">
                <button class="btn-search hvr-opacity" type="submit">
                  <ion-icon name="search"></ion-icon>
                </button>
              </div>
            </form>

            <div class="dropdown">
              <a class="hvr-opacity user-container" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-user">
                    <h1 class="fs-6 username"><?= $user['nome']." ".$user['sobrenome'] ?></h1>
                    <?php
                      if (!empty($user['imagem'])) {
                    ?>
                      <img src="data:image/jpeg;base64,<?=$user['imagem']?>" class="profile-pic" alt="Profile Picture">
                    <?php
                      } else {
                    ?>
                      <img src="../../public/img/profilePic.png" class="profile-pic" title="Voce não possui uma foto de perfil" alt="Profile Picture">
                    <?php
                      }
                    ?>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#user-form"><h2 class="fs-6">Editar Perfil</h2></a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#event-form"><h2 class="fs-6">Promover Evento</h2></a></li>
                <li><a class="dropdown-item" href="./myEvents.php"><h2 class="fs-6">Meus Eventos</h2></a></li>
                <li><a class="dropdown-item text-danger" href="../../../controllers/logout.php"><h1 class="fs-6">Sair</h1></a></li>
              </ul>

              <?php

                // INCLUINDO FORMULARIO PARA ADICIONAR EVENTOS
                include_once('./event/eventForm.php');

                // INCLUINDO FORMULARIO PARA EDITAR USUARIO
                include_once('../auth/updateUserForm.php');
              ?>
            </div>
        </nav>
      </header>

      <main class="main-content" >
      <?php
        foreach($events as $event) {
         
      ?>
          <!-- PREVIEW -->
            
          <div class="card-wrapper"> 
            <div class="card hvr-float" data-bs-toggle="modal" data-bs-target="#modal_<?=$event['id']?>">
              <div class="card-img-preview">
                <img src="data:image/jpeg;base64,<?= $event['imagem'] ?>" class="card-img" alt="...">
              </div>
              <div class="card-body">
                  <h1 class="card-title fs-6"><?= $event['titulo']?></h1>
                  <p class="card-text description"><?= $event['descricao']?></p>
              </div>
              <div class="date-container">
                  <div class="date">
                    <h1 class="fs-6">Data: <?= date("d/m/Y", strtotime($event['data'])) . " às " . $event['horario']?></h1>
                  </div>
              </div>
                <div class="presences-container">
                      Presenças Confirmadas
                      <div class="d-flex align-items-center ps-2 gap-1">
                        <span class="badge rounded-pill">
                        <?php
                          require_once(__DIR__ . '../../../../db/conn.php');
                          $count = $oEvent->getConfirmedPresences($event['id']);
                          echo $count;
                        ?>
                        </span>
                        <?php
                          require_once(__DIR__ . '../../../../db/conn.php');
                          $count = $oEvent->isParticipating($event['id'], $user['id']);
                          if($count > 0 ) {
                        ?>
                            <ion-icon class="text-success" title="Você está participando deste evento." name="checkmark-circle"></ion-icon>
                        <?php
                          }
                        ?>
                  </div>
                </div>
              <div class="card-footer-btn">
                <?php
                  if ($event['user_id'] === $user['id']) {
                ?>
                <div class="d-flex">
                    <button data-bs-toggle="modal" data-bs-target="#update_modal_<?=$event['id']?>" title="Editar Evento" class="btn edit-form-btn hvr-opacity">
                        <ion-icon name="create-outline"></ion-icon>
                    </button>
                </div>
                <div class="d-flex">
                    <button data-bs-toggle="modal" data-bs-target="#inactivate_<?=$event['id']?>"  title="Excluir Evento" type="button" class="btn edit-form-btn hvr-opacity">
                        <ion-icon name="trash-outline"></ion-icon>
                    </button>
                </div>
                <?php
                  }
                ?>
              </div>
            </div>
          </div>
          <?php
            if ($event['user_id'] === $user['id']) {
              include('./event/updateEventForm.php');
            }
          ?>

          <div class="modal fade" id="inactivate_<?=$event['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tem certeza?</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Deseja realmente inativar este evento? <br /> Ele ainda estará disponível na aba "Meus Eventos".
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <form id="inactiveEvent" action="../../../controllers/form_handler.php?action=inactive-event&eventId=<?= $event['id'] ?>" method="post">
                    <input type="hidden" name="eventId" value="<?=$event['id']?>">
                    <input type="hidden" name="userId" value="<?=$user['id']?>">
                    <button data-bs-toggle="modal" class="btn btn-danger">
                      Inativar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php
          include('./event/eventModal.php');
        }
        ?>
    </main>

    <footer class="footer">
      <img src="../../public/img/off-logo-img.png" class="logo-footer" alt="...">
      <a href="../terms/privacy.php" class="hvr-opacity" target="_blank"><h1 class="fs-6 footer-link">Política de Privacidade</h1></a>
      <a href="../terms/conditions.php" class="hvr-opacity" target="_blank"><h1 class="fs-6 footer-link">Condições de Uso</h1></a>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
