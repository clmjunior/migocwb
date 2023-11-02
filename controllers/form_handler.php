<?php

require_once __DIR__ . '/UserController.php';
require_once __DIR__ . '/EventController.php';
require_once(__DIR__ . '../../db/conn.php');

$error_message = '';

// Check the form action
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $conn = getDBConnection();

    if($conn) {
        $oEvent = new Event($conn);
        $oUser = new User($conn);
    }

    switch ($action) {
        case 'authenticate':
            $oUser->authenticate();
            break;

        case 'register-user':
            $oUser->postUser();
            break;

        case 'update-user':
            $oUser->putUser($_GET['userId']);
            break;

        case 'register-event':
            $oEvent->postEvent($_GET['userId']);
            break;
        
        case 'update-event':
            $oEvent->putEvent($_GET['eventId']);
            break;
        
        case 'inactive-event':
            $oEvent->inactiveEvent($_GET['eventId']);
            break;

        case 'active-event':
            $oEvent->activeEvent($_GET['eventId']);
            break;

        case 'confirm-presence':
            $oEvent->confirmPresence($_GET['userId'],$_GET['eventId']);
            break;

        default:
            $error_code = 1;
            $error_message = "Action inválido";
            break;
    }
} else {
    $error_code = 0;
    $error_message = 'O parâmetro "action" não foi especificado no form.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Server Error</title>
</head>
<body>
    
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Error</title>

</head>
<body class="overflow-hidden">
    <?php 
        if (!empty($error_message)) { ?>
            <div class="d-flex flex-column">
                <div class="alert alert-danger m-0 text-center">
                    <?= htmlspecialchars($error_message) ?>
                </div>;
                <div class="d-flex align-items-center w-100 justify-content-center" style="height: 80vh;">
                    <div class="w-50 border rounded-5 h-75 d-flex flex-column p-5">
                        <div class="d-flex justify-content-center align-items-center h-25">
                            <h1 class="fw-bolder text-body-tertiary">Erro no Servidor</h1>
                        </div>
                        <div class="d-flex justify-content-center align-items-center h-75">
                        <p class="fw-bolder text-body-tertiary">
                        <p class="fw-bolder text-body-tertiary">
                            <?php
                            echo ($error_code === 0)
                                ? 'Para resolver este problema, certifique-se de que o parametro action está sendo passado corretamente no formulário.<br />ex: &lt;form action="/caminho/para/o/form_handler.php<b class="text-decoration-underline">?action=action</b>&gt;" method="POST">'
                                : 'Certifique-se de que o action inserido no formulário é válido';
                            ?>
                        </p>


                        </p>
                        </div>
                    </div>
                </div>                
            </div>

    <?php 
        }; 
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
