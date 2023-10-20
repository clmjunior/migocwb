<div class="modal fade" id="eventForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Publicar Evento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../../../controllers/form_handler.php?action=register-event&userId=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="inputEmail4" class="form-label">Título do Evento</label>
                <input name="titulo" type="text" class="form-control" id="inputEmail4">
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Carregar Imagem</label>
                <input name="imagem" type="file" class="form-control-file" id="imagem">
            </div>
            <div class="mb-3">
                <label for="inputPassword4" class="form-label">Descrição</label>
                <input name="descricao" type="text" class="form-control" id="inputPassword4">
            </div>
            <div class="mb-3">
                <label for="inputAddress" class="form-label">Promoção</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="S" name="flag_promocao" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Sim
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="N" name="flag_promocao" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Não
                    </label>
                </div>            
            </div>
            <div class="mb-3">
                <label for="inputAddress2" class="form-label">Descrição da Promoção</label>
                <input name="desc_promocao" type="text" class="form-control" id="inputAddress2">
            </div>
            <div class="mb-3">
                <label for="inputAddress2" class="form-label">Hora do Evento</label>
                <input name="horario" type="time" class="form-control" id="inputAddress2">
            </div>
            <div class="mb-3">
                <label for="inputAddress2" class="form-label">Data</label>
                <input name="data" type="date" class="form-control" id="inputAddress2">
            </div>
            <div class="mb-3">
                <label for="inputZip" class="form-label">CEP</label>
                <input name="cep" type="text" class="form-control" id="inputZip" onblur="pesquisacep(this.value);">
            </div>
            <div class="mb-3">
                <label for="inputCity" class="form-label">Cidade</label>
                <input name="cidade" type="text" class="form-control" id="cidade" readonly>
            </div>
            <div class="mb-3">
                <label for="inputState" class="form-label">Estado</label>
                <input name="uf" type="text" class="form-control" id="uf" readonly>
            </div>
            <div class="mb-3">
                <label for="inputAddress2" class="form-label">Rua</label>
                <input name="rua" type="text" class="form-control" id="rua" readonly>
            </div>
            <div class="mb-3">
                <label for="inputAddress2" class="form-label">Número</label>
                <input name="numero" type="text" class="form-control" id="inputAddress2">
            </div>
            <div class="mb-3">
                <label for="inputAddress2" class="form-label">Bairro</label>
                <input name="bairro" type="text" class="form-control" id="bairro" readonly>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Publicar Evento</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>