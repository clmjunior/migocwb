<div class="modal fade" id="update_modal_<?=$event['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar Evento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-container">
            <form action="../../../controllers/form_handler.php?action=update-event&eventId=<?= $event['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="flex-form">

                    <div class="left">
                        <div class="input-container w-100">
                            <label for="image-input" class="custom-image-input">
                                <img src="data:image/jpeg;base64,<?= $event['imagem'] ?>" alt="Image Preview" class="image-preview" />
                                <span class="form-label">Trocar Imagem</span>
                            </label>
                            <input type="file" id="image-input" name="imagem" accept="image/*"/>
                        </div>
                        
                        <div class="input-container w-100 pe-2">
                            <label for="inputEmail4" class="form-label">Título do Evento</label>
                            <input name="titulo" type="text" class="form-input" id="inputEmail4" value="<?=$event['titulo']?>">
                        </div>
                        
                        <div class="input-container w-100 pe-2">
                            <label for="inputPassword4" class="form-label">Descrição</label>
                            <textarea name="descricao" type="text" class="form-input textarea-input" id="inputPassword4" ><?=$event['descricao']?></textarea>
                        </div>
                    </div>


                    <div class="right">
                        <div class="d-flex w-100">
                            <div class="input-container w-25 pe-2">
                                <label for="inputAddress" class="form-label">Promoção</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="S" name="flag_promocao" id="flexRadioDefault1"
                                        <?php
                                            if($event['flag_promocao'] === "S"){
                                                echo "checked";
                                            }
                                        ?>
                                    >
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="N" name="flag_promocao" id="flexRadioDefault2" 
                                        <?php
                                        if($event['flag_promocao'] === "N"){
                                            echo "checked";
                                        }
                                        ?>
                                    >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Não
                                    </label>
                                </div>            
                            </div>
                            <div class="input-container w-75 pe-2">
                                <label for="inputAddress2" class="form-label">Descrição da Promoção</label>
                                <textarea name="desc_promocao" type="text" class="form-input textarea-input" id="inputAddress2" ><?=$event['desc_promocao']?></textarea>
                            </div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="input-container w-25 pe-2">
                                <label for="inputAddress2" class="form-label">Horário</label>
                                <input name="horario" type="time" class="form-input" id="inputAddress2" value="<?=$event['horario']?>">
                            </div>
                            <div class="input-container w-75 pe-2">
                                <label for="inputAddress2" class="form-label">Data</label>
                                <input name="data" type="date" class="form-input" id="inputAddress2" value="<?=$event['data']?>">
                            </div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="input-container w-75 pe-2">
                                <label for="inputZip" class="form-label">CEP</label>
                                <input name="cep" type="text" class="form-input" id="inputZip" onblur="pesquisacep(this.value);" value="<?=$event['cep']?>">
                            </div>
                            <div class="input-container w-25 pe-2">
                                <label for="inputAddress2" class="form-label">Número</label>
                                <input name="numero" type="text" class="form-input" id="inputAddress2" value="<?=$event['numero']?>">
                            </div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="input-container w-25 pe-2">
                                <label for="inputState" class="form-label">UF</label>
                                <input name="uf" type="text" class="form-input" id="uf" readonly value="<?=$event['uf']?>">
                            </div>
                            
                            <div class="input-container w-75 pe-2">
                                <label for="inputCity" class="form-label">Cidade</label>
                                <input name="cidade" type="text" class="form-input" id="cidade" readonly value="<?=$event['cidade']?>">
                            </div>
                        </div>
                        <div class="d-flex w-100">
                            <div class="input-container w-50 pe-2">
                                <label for="inputAddress2" class="form-label">Bairro</label>
                                <input name="bairro" type="text" class="form-input" id="bairro" readonly value="<?=$event['bairro']?>">
                            </div>
                            <div class="input-container w-50 pe-2">
                                <label for="inputAddress2" class="form-label">Rua</label>
                                <input name="rua" type="text" class="form-input" id="rua" readonly value="<?=$event['rua']?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Atualizar Evento</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>