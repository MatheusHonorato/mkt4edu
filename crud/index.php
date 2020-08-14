<?php
    include("header.php");
    require 'config.php';
    require 'dao/ContatoDaoMysql.php';

    $contatoDao = new ContatoDaoMysql($pdo);
    $lista = $contatoDao->findAll();
?>

<div class="d-flex justify-content-between align-items-center">
    <h1>Contatos</h1>
    <a href="" class="btn btn-success mt-3 mb-3" data-toggle="modal" data-target="#modalAdicionar">Novo</a>
</div>

<table class="table table-hover">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">NOME</th>
        <th scope="col">EMAIL</th>
        <th scope="col">CELULAR</th>
        <th scope="col">AÇÕES</th>
    </tr>
    <?php foreach($lista as $contato): ?>
        <tr>
            <td><?=$contato->getId();?></td>
            <td><?=$contato->getNome();?></td>
            <td><?=$contato->getEmail();?></td>
            <td><?=$contato->getCelular();?></td>
            <td>
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar<?=$contato->getId();?>">Editar</a>
                
                <!-- Modal Editar -->
                <div class="modal fade" id="modalEditar<?=$contato->getId();?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditarlLabel">Editar Contato</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="editar_action.php">
                                <input type="hidden" name="id" value="<?=$contato->getId();?>" />
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="nome" value="<?=$contato->getNome();?>" minlength="1" maxlength="60" required/>
                                    </div>

                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control" name="email" value="<?=$contato->getEmail();?>" minlength="3" maxlength="60" required/>
                                    </div>

                                    <div class="form-group">
                                        <label>Celular</label>
                                        <input type="tel" class="form-control phone" name="celular" minlength="8" maxlength="15" value="<?=$contato->getCelular();?>" min="8" required/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <a class="btn btn-danger" href="excluir.php?id=<?=$contato->getId();?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Modal Criar -->
<div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdicionarlLabel">Adicionar Contato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" action="adicionar_action.php">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" minlength="1" maxlength="60" required/>
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email" minlength="3" maxlength="60" required/>
                </div>

                <div class="form-group">
                    <label>Celular</label>
                    <input type="tel" class="form-control phone" name="celular" minlength="8" maxlength="15" required/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>
