<?php

include_once("../../models/permissao.php");

Verificar_Permissão_Pag();
require_once('C:/xampp/htdocs/project/models/usuario.php');
require_once('C:/xampp/htdocs/project/controller/usuarioController.php');
require_once("C:/xampp/htdocs/project/controller/EstadoController.php");
require_once("C:/xampp/htdocs/project/controller/TipoUsuarioController.php");
require_once("C:/xampp/htdocs/project/controller/CidadeController.php");

$AuxReqTipoUser = new TipoUserControll();
$TipoUsu = $AuxReqTipoUser->ListarTipoUser();

$AuxReqCidade = new CidadeControll();
$cidade = $AuxReqCidade->listarCidades();

$AuxReqEstado = new EstadoControll();
$Estado = $AuxReqEstado->listarEstados();

$Aux_obter_Controll = new UsuarioController();
$usu = $Aux_obter_Controll->ObterUsuarioControll($_GET['id']);


if (isset($_POST['alterar'])) {

    if ($_POST['senha'] === $_POST['confSenha']) {
        $usuario = new UsuarioModel(
            // nome
            // cpf
            // email
            // senha
            // confSenha
            // endereco
            // cidade
            // estado
            // complemento
            null,
            $_POST['nome'],
            $_POST['cpf'],
            $_POST['telefone'],
            $_POST['email'],
            $_POST['tipo_usuario'],
            $_POST['endereco'],
            $_POST['numero'],
            $_POST['estado'],
            $_POST['cidade'],
            $_POST['complemento']
        );

        $AuxControllUsu = new UsuarioController();
        $AuxControllUsu->AlterarUsuarioControll($usuario, $_GET['id']);
    } else {
        echo "<script>alert('Senhas não conferem!');</script>";
    }
}
include_once('./menu.php');
?>


<!-- Content Wrapper -->
<div id="content-wrapper">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include_once('header.php') ?>
        <!-- End of Topbar -->

        <!--CONTEUDO -->
        <div class="w-100 p-3 h-100 row justify-content-md-center">
            <div class="w-75">
                <form class="w-80" method="POST">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="NomeProduto" class="form-label">Nome do Usuario:</label>
                            <input id="nome" name="nome" type="text" class="form-control" id="NomeProduto" value="<?= $usu['usu_nome'] ?>" required>
                        </div>
                        <div class="form-group col-md-auto">
                            <label for="TipoUsuario">Grupo:</label>
                            <select id="tipo_usuario" name="tipo_usuario" class="form-control">
                                <option selected required disabled>-- SELECIONAR --</option>
                                <?php foreach ($TipoUsu as $TipoUsuario): ?>
                                    <option value="<?= $TipoUsuario['id_tipo_user'] ?>" <?= ($usu['usu_tipo'] == $TipoUsuario['id_tipo_user']) ? 'selected' : '' ?>><?= $TipoUsuario['tipo_user_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="cpf">CPF:</label>
                            <div class="input-group">
                                <input id="cpf" name="cpf" type="text" class="form-control" aria-label="cpf do usuario" value="<?= $usu['usu_cpf'] ?>" required>
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="telefone">Telefone:</label>
                            <div class="input-group">
                                <input id="telefone" name="telefone" type="text" class="form-control" aria-label="Telefone do Usuario" value="<?= $usu['usu_telefone'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="email">E-mail:</label>
                            <div class="input-group">
                                <input id="email" name="email" type="email" class="form-control" aria-label="Email do Usuario" value="<?= $usu['usu_email'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-5 col">
                            <label for="senha">Senha:</label>
                            <div class="input-group">
                                <input id="senha" name="senha" type="password" class="form-control" aria-label="senha do usuario" value="<?= $usu['usu_senha'] ?>" required>
                            </div>
                        </div>
                        <div class="input-group mb-5 col">
                            <label for="confSenha">Confirmar senha:</label>
                            <div class="input-group">
                                <input id="confSenha" name="confSenha" type="password" class="form-control" aria-label="confSenha do Usuario" value="<?= $usu['usu_senha'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group mb-3 col">
                            <label for="endereco">Endereco</label>
                            <div class="input-group">
                                <input id="endereco" name="endereco" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $usu['usu_endereco'] ?>" required>
                            </div>
                        </div>

                        <div class="form+--group col-md-auto">
                            <label for="endereco">Numero</label>
                            <div class="input-group">
                                <input id="numero" name="numero" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $usu['usu_numero'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col mb-3 w-100">
                            <label for="cidade">Cidade</label>
                            <select id="cidade" name="cidade" class="form-control">
                                <option selected required disabled>-- SELECIONAR --</option>
                                <?php foreach ($cidade as $cidadeU): ?>
                                    <option value="<?= $cidadeU['id_cidade'] ?>"<?= ($cidadeU['id_cidade'] == $usu['usu_cidade'] ) ? 'selected' : '' ?>><?= $cidadeU['nome_cidade'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="form-group col-md-auto">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-control">
                                <option selected required disabled>-- SELECIONAR --</option>
                                <?php foreach ($Estado as $EstadoU): ?>
                                    <option value="<?= $EstadoU['id_estado'] ?>"<?= ($EstadoU['id_estado'] == $usu['usu_estado'] ) ? 'selected' : '' ?>><?= $EstadoU['nome_estado'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="complemento">Complemento</label>
                            <div class="input-group">
                                <input id="complemento" name="complemento" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $usu['usu_complemento'] ?>">
                            </div>
                        </div>
                    </div>
                    <br />
                    <button name="alterar" type="submit" class="btn btn-primary">Alterar</button>
                    <a href="./usuarios.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- END CONTEUDO -->


        <?php include_once('footer.php'); ?>