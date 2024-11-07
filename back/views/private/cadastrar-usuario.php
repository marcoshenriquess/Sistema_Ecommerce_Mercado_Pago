<?php 




require_once('C:/xampp/htdocs/project/back/models/usuario.php');
require_once('C:/xampp/htdocs/project/back/controller/usuarioController.php');
require_once("C:/xampp/htdocs/project/back/controller/TipoProdutoController.php");

$produtoDAO = new TipoProdutoController();
$TipoProd = $produtoDAO->ListarTipoProduto();



if (isset($_POST['cadastrar'])) {
    
    if($_POST['senha'] === $_POST['confSenha']){
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
            $_POST['senha'],
            $_POST['tipo_usuario'],
            $_POST['endereco'],
            $_POST['estado'],
            $_POST['cidade'],
            $_POST['complemento']
        );
        
        $AuxControllUsu = new UsuarioController();
        $AuxControllUsu->CadastroUsuarioControll($usuario);
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
                            <input id="nome" name="nome" type="text" class="form-control" id="NomeProduto" required>
                        </div>
                        <div class="form-group col-md-auto">
                            <label for="TipoUsuario">Grupo:</label>
                            <select id="tipo_usuario" name="tipo_usuario" class="form-control">
                                <option selected required disabled>-- SELECIONAR --</option>
                                <option value="3">Cliente</option>
                                <option value="2">Vendedor</option>
                                <option value="1">Administrador</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="cpf">CPF:</label>
                            <div class="input-group">
                                <input id="cpf" name="cpf" type="text" class="form-control" aria-label="cpf do usuario" required>
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="telefone">Telefone:</label>
                            <div class="input-group">
                                <input id="telefone" name="telefone" type="text" class="form-control" aria-label="Telefone do Usuario" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="email">E-mail:</label>
                            <div class="input-group">
                                <input id="email" name="email" type="email" class="form-control" aria-label="Email do Usuario" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-5 col">
                            <label for="senha">Senha:</label>
                            <div class="input-group">
                                <input id="senha" name="senha" type="text" class="form-control" aria-label="senha do usuario" required>
                            </div>
                        </div>
                        <div class="input-group mb-5 col">
                            <label for="confSenha">Confirmar senha:</label>
                            <div class="input-group">
                                <input id="confSenha" name="confSenha" type="confSenha" class="form-control" aria-label="confSenha do Usuario" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="endereco">Endereco</label>
                            <div class="input-group">
                                <input id="endereco" name="endereco" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                        <div class="mb-3 col">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input name="cidade" type="text" class="form-control" id="cidade" aria-describedby="cidade do usuario">
                        </div>

                        <div class="form-group col-2">
                            <label for="estado">Estado:</label>
                            <select id="estado" name="estado" class="form-control">
                                <option selected required disabled>-- SELECIONAR --</option>
                                <option value="1">SP</option>
                                <option value="2">SP</option>
                                <option value="3">SP</option>
                                <option value="4">SP</option>
                                <option value="5">SP</option>
                                <option value="6">SP</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="complemento">Complemento</label>
                            <div class="input-group">
                                <input id="complemento" name="complemento" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                    </div>
                    <br />
                    <button name="cadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="./produtos.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- END CONTEUDO -->


        <?php include_once('footer.php'); ?>