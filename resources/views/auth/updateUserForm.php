 <div class="modal fade" id="user-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-md">
    <div class="modal-content modal-content-beige">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body overflow-hidden">
        <div class="form-container">
            <form action="../../../controllers/form_handler.php?action=update-user&userId=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="flex-form flex-column">
                    <div class="flex-form">

                        <div class="left">
                            <div class="input-container w-100 pb-2">
                                <label for="profile-image-input" class="custom-profile-image-input">
                                    <?php
                                        if (!empty($user['imagem'])) {
                                            echo '<img src="data:image/jpeg;base64,' . $user['imagem'] . '" class="profile-image-preview" />';
                                        } else {
                                            echo '<span class="form-label">Trocar Imagem</span>';
                                        }
                                    ?>                            
                                </label>
                                <input type="file" id="profile-image-input" name="imagem-perfil" accept="image/*"/>
                            </div>
                        </div>

                        <div class="right">
                            <div class="input-container w-100 pe-2">
                                <label for="inputEmail4" class="form-label">Nome</label>
                                <input name="nome" type="text" class="form-input" id="inputEmail4" placeholder="Nome" value="<?=$user['nome']?>">
                            </div>
                            <div class="input-container w-100 pe-2">
                                <label for="inputPassword4" class="form-label">Sobrenome</label>
                                <input name="sobrenome" type="text" class="form-input" id="inputPassword4" placeholder="Sobrenome" value="<?=$user['sobrenome']?>">
                            </div>
                        </div>
                    </div>
                    <div class="input-container w-100 pe-2">
                        <label for="inputAddress" class="form-label">Email</label>
                        <input name="email" type="email" class="form-input" id="inputAddress" placeholder="Email" value="<?=$user['email']?>">
                    </div>
                    <div class="d-flex w-100">
                        <div class="input-container w-50 pe-2">
                            <label for="inputAddress2" class="form-label">Senha</label>
                            <input name="senha" type="password" class="form-input" id="inputAddress2" placeholder="Senha">
                        </div>
                        <div class="input-container w-50 pe-2">
                            <label for="inputAddress2" class="form-label">Confirmar Senha</label>
                            <input name="confirmar_senha" type="password" class="form-input" id="inputAddress2" placeholder="Confirmar Senha">
                        </div>
                    </div>
                    <div class="d-flex w-100">
                        <div class="input-container w-75 pe-2">
                            <label for="inputZip" class="form-label">CEP</label>
                            <input name="cep" type="text" class="form-input" id="inputZip" onblur="pesquisacep(this.value);" value="<?=$user['cep']?>">
                        </div>
                        <div class="input-container w-25 pe-2">
                            <label for="inputAddress2" class="form-label">Número</label>
                            <input name="numero" type="text" class="form-input" id="inputAddress2" placeholder="Número" value="<?=$user['numero']?>">
                        </div>
                    </div>
                    <div class="d-flex w-100">
                        <div class="input-container w-25 pe-2">
                            <label for="inputState" class="form-label">UF</label>
                            <input name="uf" type="text" class="form-input" id="uf" readonly value="<?=$user['uf']?>">
                        </div>
                        
                        <div class="input-container w-75 pe-2">
                            <label for="inputCity" class="form-label">Cidade</label>
                            <input name="cidade" type="text" class="form-input" id="cidade" readonly value="<?=$user['cidade']?>">
                        </div>
                    </div>
                    <div class="d-flex w-100">
                        <div class="input-container w-50 pe-2">
                            <label for="inputAddress2" class="form-label">Bairro</label>
                            <input name="bairro" type="text" class="form-input" id="bairro" readonly value="<?=$user['bairro']?>">
                        </div>
                        <div class="input-container w-50 pe-2">
                            <label for="inputAddress2" class="form-label">Rua</label>
                            <input name="rua" type="text" class="form-input" id="rua" readonly value="<?=$user['rua']?>">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Gravar</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>