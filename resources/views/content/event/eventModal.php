<div class="modal fade" id="modal_<?=$event['id']?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-end">
                <button type="button" class="btn fs-3" data-bs-dismiss="modal" aria-label="Close"><ion-icon name="home"></ion-icon></button>
            </div>
            <div class="modal-body p-0">
                <div class="event-modal-container">
                    <div class="wrap-img">
                        <div class="modal-img-container" style="background-image: url('data:image/jpeg;base64,<?= $event['imagem'] ?>');"></div>
                        <img src="data:image/jpeg;base64,<?= $event['imagem'] ?>" class="card-img-top" alt="..." />
                    </div>
                    <div class="event-modal-content">

                        <div class="event-modal-title">
                            <h1 class="fs-6"><?= date("d/m/Y", strtotime($event['data'])) ?></h1>
                            <h1><?= $event['titulo']?></h1>
                        </div>
                        
                        <div class="event-modal-date">
                            <h1 class="fs-5 pb-3">Data e Hora</h1>
                            <p><ion-icon class="pe-2" name="calendar-outline"></ion-icon><?= $oFunc->dateToTextConversor($event['data'], $event['horario'])?></p>
                        </div>
                        
                        <div class="event-modal-local">
                            <h1 class="fs-5 pb-3">Localização</h1>
                            <p><ion-icon class="pe-2" name="pin-sharp"></ion-icon><?= $oFunc->addressConversor($event['rua'],$event['numero'], $event['uf'], $event['cep']) ?></p>
                        </div>
                        
                        <?php
                        if($event['flag_promocao'] === "S") {
                            ?>
                            <div class="event-modal-promo">
                                <h1 class="fs-5 pb-3">Promoções</h1>
                                <p><?= $event['desc_promocao']?></p>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="event-modal-about">
                            <h1 class="fs-5 pb-3">Sobre este evento</h1>
                            <p><?= $event['descricao']?></p>
                        </div>
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
        </div>
    </div>
</div>
