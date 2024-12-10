<?php


if (isset($_GET['_nocache'])) {
    // Redirecionar para a página de login
    header("Location: /project/views/private/cadastrar-usuario.php");
    exit();
}



require_once('C:/xampp/htdocs/project/models/usuario.php');
require_once('C:/xampp/htdocs/project/controller/usuarioController.php');
require_once("C:/xampp/htdocs/project/controller/EstadoController.php");
require_once("C:/xampp/htdocs/project/controller/CidadeController.php");

$AuxReqCidade = new CidadeControll();
$cidade = $AuxReqCidade->listarCidades();

$AuxReqEstado = new EstadoControll();
$Estado = $AuxReqEstado->listarEstados();

$msgErr = null;

if (isset($_POST['cadastrar'])) {
    if (isset($_POST['nome'], $_POST['cpf'], $_POST['email'], $_POST['senha'], $_POST['endereco'], $_POST['numero'], $_POST['estado'], $_POST['cidade'])) {
        $cpfMascara = strtoupper(preg_replace('/[^[:alnum:]_]/', '', $_POST['cpf']));
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
                $cpfMascara,
                $_POST['telefone'],
                $_POST['email'],
                $_POST['senha'],
                3,
                $_POST['endereco'],
                $_POST['numero'],
                $_POST['estado'],
                $_POST['cidade'],
                $_POST['complemento'],
                null,
                null,
                null
            );

            $AuxControllUsu = new UsuarioController();
            $AuxControllUsu->CadastroUsuarioControll($usuario);
        } else {
            echo "<script>alert('Senhas não conferem!');</script>";
        }
    } else {
        echo "PREENCHA OS CAMPOS OBRIGATÓRIOS";
    }
}


include_once('./head.php');
?>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="w-100">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Insira seus dados para se cadastrar!</h1>
                            </div>
                            <form class="w-80" method="POST">
                                <sup class="text-danger">* Campos Obrigatórios</sup>
                                <?php if ($msgErr != null) { ?>
                                    <div class="alert alert-danger p-3" role="alert">
                                        <?= $msgErr ?>
                                        <script>
                                            // Recarregar a página após 10 segundos (10.000 milissegundos)
                                            setTimeout(function() {
                                                const url = window.location.href.split('?')[0];
                                                window.location.href = `${url}?_nocache=${new Date().getTime()}`;
                                            }, 2000);
                                        </script>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="NomeProduto">Nome do Usuario:</label><sup class="text-danger">*</sup>
                                        <input id="nome" name="nome" type="text" class="form-control" id="NomeProduto" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="cpf">CPF:</label><sup class="text-danger">*</sup>
                                        <div class="input-group" required>
                                            <input id="cpf" name="cpf" type="text" class="form-control" aria-label="cpf do usuario">
                                        </div>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="telefone">Telefone:</label>
                                        <div class="input-group">
                                            <input id="telefone" name="telefone" type="text" class="form-control" aria-label="Telefone do Usuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="email">E-mail:</label><sup class="text-danger">*</sup>
                                        <div class="input-group" required>
                                            <input id="email" name="email" type="email" class="form-control" aria-label="Email do Usuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-5 col">
                                        <label for="senha">Senha:</label><sup class="text-danger">*</sup>
                                        <div class="input-group" required>
                                            <input id="senha" name="senha" type="password" class="form-control" aria-label="senha do usuario">
                                        </div>
                                    </div>
                                    <div class="mb-5 col">
                                        <label for="confSenha">Confirmar senha:</label><sup class="text-danger">*</sup>
                                        <div class="input-group" required>
                                            <input id="confSenha" name="confSenha" type="password" class="form-control" aria-label="confSenha do Usuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="endereco">Endereco</label><sup class="text-danger">*</sup>
                                        <div class="input-group" required>
                                            <input id="endereco" name="endereco" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="endereco">Numero</label><sup class="text-danger">*</sup>
                                        <div class="input-group" required>
                                            <input id="numero" name="numero" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col mb-3 w-100">
                                        <label for="cidade">Cidade</label><sup class="text-danger">*</sup>
                                        <select id="cidade" name="cidade" class="form-control" required>
                                            <option selected disabled>-- SELECIONAR --</option>
                                            <?php foreach ($cidade as $cidadeU): ?>
                                                <option value="<?= $cidadeU['id_cidade'] ?>"><?= $cidadeU['nome_cidade'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-auto">
                                        <label for="estado">Estado</label><sup class="text-danger">*</sup>
                                        <select id="estado" name="estado" class="form-control" required>
                                            <option selected disabled>-- SELECIONAR --</option>
                                            <?php foreach ($Estado as $EstadoU): ?>
                                                <option value="<?= $EstadoU['id_estado'] ?>"><?= $EstadoU['nome_estado'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col">
                                        <label for="complemento">Complemento</label>
                                        <div class="input-group">
                                            <input id="complemento" name="complemento" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <button name="cadastrar" type="supmit" class="btn btn-primary">Cadastrar</button>
                                <a href="./produtos.php" class="btn btn-secondary">Voltar</a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>