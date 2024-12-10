<?php
// include_once('C:/xampp/htdocs/project/models/permissao.php');

//var_dump($_SESSION['usuario_taramps']);
if (isset($_REQUEST['sair'])) {
    // ***IMPLEMENTAR VERIFICAÇÃO DE SESSÕES DE PROCEDIMENTOS FUTUROS

    //REGISTRAR LOG

    //DESTRUIR SESSÕES
    session_destroy();
}

require_once('../controller/TipoUsuarioController.php');
require_once('../controller/logoutController.php');


if (isset($_SESSION['usuario_logado'])) {
    $AuxTipoUser = new TipoUserControll();
    $TipoUsuario = $AuxTipoUser->ObeterTipoUser($_SESSION['tipo_user']);
}

?>
<nav class="navbar navbar-expand navbar-light topbar static-top shadow bg-dark">
    <div class="container w-100">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse col" id="navbarSupportedContent">
            <ul class="row navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 x-3">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow m-2 d-flex align-items-center">
                    <a class="d-flex dropdown no-arrow align-items-center text-decoration-line-through" href="carrinho.php">
                        <button class="btn btn-light h-50" type="submit">
                            <i class="fas fa-shopping-cart fa-sm fa-fw text-dark-400"></i>
                        </button>
                    </a>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow  x-5 d-flex align-items-center">
                    <?php
                    if (isset($_SESSION['usuario_logado'])) {
                    ?>
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline small txt-white">
                                Olá
                                <b><?= $_SESSION['usuario_logado']['usu_nome'] ?></b>
                            </span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="meus_dados.php">
                                <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                                Meus Dados
                            </a>
                            <hr/>
                            <a class="dropdown-item" href="pedidos.php">
                                <i class="fas fa-shopping-bag fa-sm fa-fw mr-2 text-gray-400"></i>
                                Meus Pedidos
                            </a>
                            <hr/>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Sair
                            </a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link active" href="login.php">Login &nbsp<i class="fas fa-sign-in-alt"></i></a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal de Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmar Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja sair?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button name="sair" id="sair" type="button" class="btn btn-primary" onclick="SairAll()">Sair</button>
            </div>
        </div>
    </div>
</div>
<script>
function SairAll(){
    localStorage.clear();
    window.location.href = "logout.php";
}
</script>
<!-- Bootstrap core JavaScript-->
<script src="../public/vendor/jquery/jquery.min.js"></script>
<script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../public/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../public/js/demo/chart-area-demo.js"></script>
<script src="../public/js/demo/chart-pie-demo.js"></script>