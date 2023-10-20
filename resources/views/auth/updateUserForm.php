<div class="modal fade" id="userForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="../../../controllers/form_handler.php?action=update-user&userId=<?= $user['id'] ?>" method="POST">
                        <div class="mb-3">
                            <label for="inputEmail4" class="form-label">Nome</label>
                            <input name="nome" type="text" class="form-control" id="inputEmail4" placeholder="Nome" value="<?=$user['nome']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword4" class="form-label">Sobrenome</label>
                            <input name="sobrenome" type="text" class="form-control" id="inputPassword4" placeholder="Sobrenome" value="<?=$user['sobrenome']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="inputAddress" placeholder="Email" value="<?=$user['email']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress2" class="form-label">Senha</label>
                            <input name="senha" type="password" class="form-control" id="inputAddress2" placeholder="Senha">
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress2" class="form-label">Confirmar Senha</label>
                            <input name="confirmar_senha" type="password" class="form-control" id="inputAddress2" placeholder="Confirmar Senha">
                        </div>
                        <div class="mb-3">
                            <label for="inputZip" class="form-label">CEP</label>
                            <input name="cep" type="text" class="form-control" id="inputZip" onblur="pesquisacep(this.value);" value="<?=$user['cep']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputCity" class="form-label">Cidade</label>
                            <input name="cidade" type="text" class="form-control" id="cidade" readonly value="<?=$user['cidade']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputState" class="form-label">Estado</label>
                            <input name="uf" type="text" class="form-control" id="uf" readonly value="<?=$user['uf']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress2" class="form-label">Rua</label>
                            <input name="rua" type="text" class="form-control" id="rua" readonly value="<?=$user['rua']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress2" class="form-label">Bairro</label>
                            <input name="bairro" type="text" class="form-control" id="bairro" readonly value="<?=$user['bairro']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress2" class="form-label">Número</label>
                            <input name="numero" type="text" class="form-control" id="inputAddress2" placeholder="Número" value="<?=$user['numero']?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Gravar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>