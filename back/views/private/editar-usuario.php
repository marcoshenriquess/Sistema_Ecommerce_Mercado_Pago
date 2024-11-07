<?php



require_once('C:/xampp/htdocs/project/back/models/usuario.php');
require_once('C:/xampp/htdocs/project/back/controller/usuarioController.php');
require_once("C:/xampp/htdocs/project/back/controller/TipoProdutoController.php");

$Aux_obter_Controll = new UsuarioController();
$usu = $Aux_obter_Controll->ObterUsuarioControll($_GET['id']);



if (isset($_POST['alterar'])) {
    
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
                            <input id="nome" name="nome" type="text" class="form-control" id="NomeProduto" value="<?= $usu['nome'] ?>" required>
                        </div>
                        <div class="form-group col-md-auto">
                            <label for="TipoUsuario">Grupo:</label>
                            <select id="tipo_usuario" name="tipo_usuario" class="form-control">
                                <option required disabled>-- SELECIONAR --</option>
                                <option value="1" <?= ($usu['tipo_user_nome'] == 'Administrador' ) ? 'selected' : '' ?>>Administrador</option>
                                <option value="2" <?= ($usu['tipo_user_nome'] == 'Vendedor' ) ? 'selected' : '' ?>>Vendedor</option>
                                <option value="3" <?= ($usu['tipo_user_nome'] == 'Cliente' ) ? 'selected' : '' ?>>Cliente</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="cpf">CPF:</label>
                            <div class="input-group">
                                <input id="cpf" name="cpf" type="text" class="form-control" aria-label="cpf do usuario" value="<?= $usu['cpf'] ?>" required>
                            </div>
                        </div>
                        <div class="input-group mb-3 col">
                            <label for="telefone">Telefone:</label>
                            <div class="input-group">
                                <input id="telefone" name="telefone" type="text" class="form-control" aria-label="Telefone do Usuario" value="<?= $usu['numero'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="email">E-mail:</label>
                            <div class="input-group">
                                <input id="email" name="email" type="email" class="form-control" aria-label="Email do Usuario" value="<?= $usu['email'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-5 col">
                            <label for="senha">Senha:</label>
                            <div class="input-group">
                                <input id="senha" name="senha" type="password" class="form-control" aria-label="senha do usuario" value="<?= $usu['senha'] ?>" required>
                            </div>
                        </div>
                        <div class="input-group mb-5 col">
                            <label for="confSenha">Confirmar senha:</label>
                            <div class="input-group">
                                <input id="confSenha" name="confSenha" type="password" class="form-control" aria-label="confSenha do Usuario" value="<?= $usu['senha'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="endereco">Endereco</label>
                            <div class="input-group">
                                <input id="endereco" name="endereco" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $usu['endereco'] ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 col">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input name="cidade" type="text" class="form-control" id="cidade" aria-describedby="cidade do usuario" value="<?= $usu['cidade'] ?>">
                        </div>

                        <div class="form-group col-2">
                            <label for="estado">Estado:</label>
                            <select id="estado" name="estado" class="form-control">
                                <option required disabled>-- SELECIONAR --</option>
                                <option value="SP" <?= ($usu['estado'] == 'SP' ) ? 'selected' : '' ?>>SP</option>
                                <option value="MG" <?= ($usu['estado'] == 'MG' ) ? 'selected' : '' ?>>MG</option>
                                <option value="DF" <?= ($usu['estado'] == 'DF' ) ? 'selected' : '' ?>>DF</option>
                                <option value="AM" <?= ($usu['estado'] == 'AM' ) ? 'selected' : '' ?>>AM</option>
                                <option value="RJ" <?= ($usu['estado'] == 'RJ' ) ? 'selected' : '' ?>>RJ</option>
                                <option value="SC" <?= ($usu['estado'] == 'SC' ) ? 'selected' : '' ?>>SC</option>
                                <option value="RS" <?= ($usu['estado'] == 'RS' ) ? 'selected' : '' ?>>RS</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-3 col">
                            <label for="complemento">Complemento</label>
                            <div class="input-group">
                                <input id="complemento" name="complemento" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $usu['complemento'] ?>" >
                            </div>
                        </div>
                    </div>
                    <br />
                    <button name="alterar" type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="./usuarios.php" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>

        <!-- END CONTEUDO -->


        <?php include_once('footer.php'); ?>