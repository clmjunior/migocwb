<?php
require_once('../../../controllers/UserController.php');
require_once('../../../controllers/EventController.php');

session_start();

if (!$_SESSION['id']) {
  $message = 'Você deve efetuar o login para visualizar o conteudo!';
  header('Location: ../auth/login.php?message=' . urlencode($message));
  exit;

} else {
  require_once(__DIR__ . '../../../../db/conn.php');
  $events = Event::setConnection($conn);
  $events = User::setConnection($conn);

  $user = User::getUser($_SESSION['id'],$conn);
  $events = Event::getMyEvents($user['id']);
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
        <link rel="stylesheet" type="text/css" href="./styledContent.css"/>
        <script src="../../public/js/scripts.js"></script>
        <title>MigoCWB</title>
    </head>
    <body class="d-flex flex-column">
  
        <header>
  
          <!-- NAVBAR -->
          <nav class="navbar navbar-expand-lg px-3">
            <div class="container-fluid"> 
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              
              <div class="collapse navbar-collapse d-flex justify-content-between w-100" id="navbarSupportedContent">
              
                <a class="navbar-brand" style="width: 9vw;" href="#">
                  <img src="../../public/img/logo.png" class="img-fluid img_logo" alt="..." >
                </a>
  
                <div class="d-flex w-50 justify-content-center">
                  <form class="d-flex w-100" role="search">
                    <input class="form-control me-2 " type="search" placeholder="Pesquisar Eventos" aria-label="Search">
                    <button class="btn btn-outline-primary d-flex align-items-center" type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                      </svg>
                  </button>
                  </form>
                </div>
  
                <div class="nav-item dropdown">
                  <a href="#" class="text-decoration-none text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="d-flex align-items-center">
                      <p class="fw-bolder pe-3 pt-3"><?= $user['nome']." ".$user['sobrenome'] ?></p>
                        <img src="../../public/img/profilePic.png" class="img-fluid rounded-circle" style="width:4vw;" alt="Profile Picture">
                  </div>
                  </a>
                  <ul class="dropdown-menu me-5">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userForm">Editar Perfil</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eventForm">Promover Evento</a></li>
                    <li><a class="dropdown-item" href="./myEvents.php">Meus Eventos</a></li>
                    <li><a class="dropdown-item text-danger" href="../../../controllers/logout.php">Sair</a></li>
                  </ul>
                  <?php
  
                    // INCLUINDO FORMULARIO PARA ADICIONAR EVENTOS
                    include_once('./event/eventForm.php');
  
                    // INCLUINDO FORMULARIO PARA EDITAR USUARIO
                    include_once('../auth/updateUserForm.php');
                  ?>
                </div>
  
              </div>
            </div>
          </nav>
        </header>
  
        <main class="d-flex flex-wrap justify-content-evenly w-100 main-content flex-wrap" >
        <?php
          foreach($events as $event) {
           $isActiveStyle = $event['flag_ativo'] === "N" ? "opacity-50" : "";
        ?>
            <!-- PREVIEW -->
            <div class="w-25 px-4 mt-5 mb-2 card-wrapper <?= $isActiveStyle ?>"> 
              <div class="card rounded-4 p-3 h-100 w-100 " data-bs-toggle="modal" data-bs-target="#modal_<?=$event['id']?>">
                <div class="card-img-preview d-flex align-items-center mb-2 p-3 justify-content-center">
                  <img src="data:image/jpeg;base64,<?= $event['imagem'] ?>" class="card-img rounded-2" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bolder"><?= $event['titulo']?></h5>
                    <p class="card-text description"><?= $event['descricao']?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-center"><p class="me-1 mb-0 fw-bold">Data:</p><?= $event['data']." às ".$event['horario']?></li>
                </ul>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-center">
                            Presenças Confirmadas
                         <div class="d-flex align-items-center ps-2 gap-1">
                            <span class="badge bg-primary rounded-pill">
                            <?php
                              $count = Event::getConfirmedPresences($event['id']);
                              echo $count;
                            ?>
                            </span>
                            <?php
                              $count = Event::isParticipating($event['id'], $user['id']);
                              if($count > 0 ) {
                            ?>
                            <ion-icon class="text-success" title="Você está participando deste evento." name="checkmark-circle"></ion-icon>
                            <?php
                            }
                            ?>
                      </div>
                    </li>
                </ul>
              </div>
            <?php
                if ($event['user_id'] === $user['id'] && $event['flag_ativo'] === "S") {
                    ?>
                    <div class="edit-buttons-container d-flex justify-content-end ms-3">
                        <div class="d-flex">
                            <button data-bs-toggle="modal" data-bs-target="#update_modal_<?=$event['id']?>" title="Editar Evento" class="btn-wrap btn btn-warning pt-2 text-light d-flex align-items-center justify-content-center fs-6 pt-4 edit-form-btn ">
                                <ion-icon name="create-outline"></ion-icon>
                            </button>
                        </div>
                        <div class="d-flex">
                            <button data-bs-toggle="modal" data-bs-target="#inactivate_<?=$event['id']?>"  title="Excluir Evento" type="button" class="btn btn-primary btn-wrap btn btn-danger pt-2 text-light d-flex align-items-center justify-content-center fs-6 pt-4 edit-form-btn">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                    <?php
                } else if($event['user_id'] === $user['id'] && $event['flag_ativo'] === "N") {
                    ?>
                    <div class="edit-buttons-container d-flex justify-content-end ms-3">
                        <div class="d-flex">
                            <form id="inactiveEvent" action="../../../controllers/form_handler.php?action=active-event&userId=<?= $user['id']?>&eventId=<?= $event['id'] ?>" method="post">
                                <button title="Reativar Evento" class="btn btn-primary btn-wrap btn btn-primary pt-2 text-light d-flex align-items-center justify-content-center fs-6 pt-4 edit-form-btn">
                                    <ion-icon name="refresh-outline"></ion-icon>
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
  
                include('./event/updateEventForm.php');
              ?>
            </div>
  
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
                      <button data-bs-toggle="modal" class="btn btn-danger">
                        Inativar
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- MODAL VER MAIS -->
            <div class="modal fade modal-lg" id="modal_<?=$event['id']?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $event['titulo']?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="p-5 d-flex align-items-center justify-content-center">
                          <img src="data:image/jpeg;base64,<?= $event['imagem'] ?>" class="card-img-top rounded-2" alt="...">
                        </div>
                          <div class="mt-3 px-5">
                            
                            <h1>Descrição do Evento</h1>
                            <p><?= $event['descricao']?></p>
                            <?php
                              if($event['flag_promocao'] === "S") {
                                ?>
                            <h3 class="fw-bolder">Promoção</h3>
                            <p><?= $event['desc_promocao']?></p>
                            <?php
                            }
                            ?>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <form id="confirmPresenceForm" action="../../../controllers/form_handler.php?action=confirm-presence&userId=<?= $user['id']?>&eventId=<?= $event['id'] ?>" method="post">
                      <input type="hidden" name="action" value="confirmPresence">
                      <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                      <input type="hidden" name="eventId" value="<?= $event['id'] ?>">
                      <button type="submit" class="btn btn-primary">Confirmar Presença</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
      </main>
  
      <footer class="footer justify-self-end mt-5 d-flex pt-1 fixed-footer">
          <div class="d-flex flex-column justify-content-center align-items-center w-100 gap-3">
              <a href="../terms/privacy.php" class="text-decoration-none fw-bolder text-body-tertiary" target="_blank">Política de Privacidade</a>
              <a href="../terms/conditions.php" class="text-decoration-none fw-bolder text-body-tertiary" target="_blank">Condições de Uso</a>
          </div>
      </footer>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
  </html>