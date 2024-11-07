<?php

require_once("C:/xampp/htdocs/project/back/controller/usuarioController.php");
$UsuarioCont = new UsuarioController();
$List = $UsuarioCont->ListaUsuarioControll();
?>




<!-- Sidebar -->
<?php include_once('menu.php') ?>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include_once('header.php') ?>
        <!-- End of Topbar -->

        <!--CONTEUDO -->
        <div class="w-100 p-3 h-100 ">
            <div class="w-100 m-3">
                <a class="btn btn-primary" href="cadastrar-usuario.php">Cadastrar novo Usuário</a>
            </div>
            <table class="table">
                <thead>
                    <tr >
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Tipo de Usuario</th>
                        <th scope="col" colspan="2" class="align-text-bottom">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($List as $usuario): ?>
                        <tr>
                            <th><?= $usuario['nome'] ?></th>
                            <td><?= $usuario['email'] ?></td>
                            <td><?= $usuario['cidade'] ?></td>
                            <td><?= $usuario['estado'] ?></td>
                            <td><?= $usuario['tipo_user_nome'] ?></td>
                            <td><a class="btn btn-secondary" href="editar-usuario.php?id=<?= $usuario['id_usuario'] ?>">Editar</a></td>
                            <td>
                                <form action="excluir-usuario.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">
                                    <input type="submit" class="btn btn-danger" value="Excluir">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- END CONTEUDO -->

        <?php include_once('./footer.php');      ?>