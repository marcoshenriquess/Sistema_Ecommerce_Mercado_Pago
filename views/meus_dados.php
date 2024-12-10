<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: /project/views/login.php");
    exit();
}

require_once(dirname(__DIR__) . "/controller/usuarioController.php");
require_once(dirname(__DIR__) . "/controller/EstadoController.php");
require_once(dirname(__DIR__) . "/controller/TipoUsuarioController.php");
require_once(dirname(__DIR__) . "/controller/CidadeController.php");

$AuxReqTipoUser = new TipoUserControll();
$TipoUsu = $AuxReqTipoUser->ListarTipoUser();
$AuxReqEstado = new EstadoControll();
$Estado = $AuxReqEstado->listarEstados();
$AuxReqCidade = new CidadeControll();
$cidade = $AuxReqCidade->listarCidades();

$AuxControllUsu = new UsuarioController();
$usu = $AuxControllUsu->ObterUsuarioControll($_SESSION['usuario_logado']['usu_id']);


if (isset($_POST['alterar'])) {
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
        null,
        null,
        $_POST['endereco'],
        $_POST['numero'],
        $_POST['estado'],
        $_POST['cidade'],
        $_POST['complemento']
    );

    $AuxControllUsu = new UsuarioController();
    $AuxControllUsu->AlterarUsuarioControllPessoal($usuario, $_SESSION['usuario_logado']['usu_id']);
    
}



include_once('head.php');
?>

<style>
    #formulario input:disabled,
    #formulario select:disabled {
        background: #ccc;
    }
</style>

<body class="bg-light">
    <!-- Topbar -->
    <?php include_once('menu.php') ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" class="w-100 d-flex justify-content-md-center">



            <div class="w-75 p-3 h-100 row justify-content-md-center">
                <div class="w-75">
                    <form class="w-80" method="POST" id="formulario">
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="NomeProduto" class="form-label">Nome do Usuario:</label>
                                <input disabled id="nome" name="nome" type="text" class="form-control" id="NomeProduto" value="<?= $usu['usu_nome'] ?>" required>
                            </div>
                            <!-- <div class="form-group col-md-auto">
                                <label for="TipoUsuario">Grupo:</label>
                                <select disabled id="tipo_usuario" name="tipo_usuario" class="form-control">
                                    <option selected required>-- SELECIONAR --</option>
                                    <?php foreach ($TipoUsu as $TipoUsuario): ?>
                                        <option value="<?= $TipoUsuario['id_tipo_user'] ?>" <?= ($usu['usu_tipo'] == $TipoUsuario['id_tipo_user']) ? 'selected' : '' ?>><?= $TipoUsuario['tipo_user_nome'] ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div> -->
                        </div>
                        <div class="row">
                            <div class="input-group mb-3 col">
                                <label for="cpf">CPF:</label>
                                <div class="input-group">
                                    <input disabled id="cpf" name="cpf" type="text" class="form-control" aria-label="cpf do usuario" value="<?= $usu['usu_cpf'] ?>" required>
                                </div>
                            </div>
                            <div class="input-group mb-3 col">
                                <label for="telefone">Telefone:</label>
                                <div class="input-group">
                                    <input disabled id="telefone" name="telefone" type="text" class="form-control" aria-label="Telefone do Usuario" value="<?= $usu['usu_telefone'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3 col">
                                <label for="email">E-mail:</label>
                                <div class="input-group">
                                    <input disabled id="email" name="email" type="email" class="form-control" aria-label="Email do Usuario" value="<?= $usu['usu_email'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group mb-3 col">
                                <label for="endereco">Endereco</label>
                                <div class="input-group">
                                    <input disabled id="endereco" name="endereco" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $usu['usu_endereco'] ?>" required>
                                </div>
                            </div>

                            <div class="form+--group col-md-auto">
                                <label for="endereco">Numero</label>
                                <div class="input-group">
                                    <input disabled id="numero" name="numero" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $usu['usu_numero'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col mb-3 w-100">
                                <label for="cidade">Cidade</label>
                                <select disabled id="cidade" name="cidade" class="form-control">
                                    <option selected required>-- SELECIONAR --</option>
                                    <?php foreach ($cidade as $cidadeU): ?>
                                        <option value="<?= $cidadeU['id_cidade'] ?>" <?= ($cidadeU['id_cidade'] == $usu['usu_cidade']) ? 'selected' : '' ?>><?= $cidadeU['nome_cidade'] ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="form-group col-md-auto">
                                <label for="estado">Estado</label>
                                <select disabled id="estado" name="estado" class="form-control">
                                    <option selected required>-- SELECIONAR --</option>
                                    <?php foreach ($Estado as $EstadoU): ?>
                                        <option value="<?= $EstadoU['id_estado'] ?>" <?= ($EstadoU['id_estado'] == $usu['usu_estado']) ? 'selected' : '' ?>><?= $EstadoU['nome_estado'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3 col">
                                <label for="complemento">Complemento</label>
                                <div class="input-group">
                                    <input disabled id="complemento" name="complemento" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $usu['usu_complemento'] ?>">
                                </div>
                            </div>
                        </div>
                        <br />
                        <div id="opcoes-alterar-dados" class="esconder">
                            <button name="alterar" type="submit" class="btn btn-primary">Alterar</button>
                            <a class="btn btn-warning" type="button" onclick="DesfazerDisabled()">Voltar</a>
                        </div>
                    </form>
                    <input id="HabilitarAlteracao" class="btn btn-success Mostrar" type="button" value="Alterar meus dados" onclick="AlterDados()">
                </div>
            </div>
        </div>
    </div>
    <script>
        function AlterDados() {
            var inputItems = document.querySelectorAll('#formulario input');
            inputItems.forEach(element => {
                element.removeAttribute("disabled");
            });

            var SelectItems = document.querySelectorAll('#formulario select');
            SelectItems.forEach(element => {
                element.removeAttribute("disabled");
            });

            const opcoesAlterar = document.querySelector('#opcoes-alterar-dados');
            const classDisable = document.querySelector('#HabilitarAlteracao');
            const VoltaDisabled = document.querySelector('#VoltarHabilitar');
            if (opcoesAlterar.classList == 'esconder') {
                classDisable.className = 'btn btn-success esconder';
                opcoesAlterar.className = 'Mostrar';
            } else {
                classDisable.className = 'btn btn-success Mostrar';
                opcoesAlterar.className = 'esconder';
            }


            // classDisable.textContent = 'd-none';
        }

        function DesfazerDisabled() {
            var inputItems = document.querySelectorAll('#formulario input');
            inputItems.forEach(element => {
                element.setAttribute("name", "TESTE");
                element.setAttribute("disabled", "");
            });

            var SelectItems = document.querySelectorAll('#formulario select');
            SelectItems.forEach(element => {
                element.setAttribute("name", "TESTE");
                element.setAttribute("disabled", "");
            });

            const opcoesAlterar = document.querySelector('#opcoes-alterar-dados');
            const classDisable = document.querySelector('#HabilitarAlteracao');
            const VoltaDisabled = document.querySelector('#VoltarHabilitar');
            if (opcoesAlterar.classList == 'Mostrar') {
                classDisable.className = 'btn btn-success Mostrar';
                opcoesAlterar.className = 'esconder';
            } else {
                classDisable.className = 'btn btn-success esconder';
                opcoesAlterar.className = 'Mostrar';
            }
        }
    </script>
</body>

</html>